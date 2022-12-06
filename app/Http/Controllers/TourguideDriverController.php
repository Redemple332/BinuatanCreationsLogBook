<?php

namespace App\Http\Controllers;

use App\Exports\SummaryExport;
use App\Models\TourguideDriver;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class TourguideDriverController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if($search){
            $TGDrivers = TourguideDriver::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhere('agency', 'LIKE', "%$search%")
                    ->orWhere('occupation', 'LIKE', "%$search%");
                })->with('logBooks.logBook')->orderBy('name')->get();

        }else{
            $TGDrivers = TourguideDriver::with('logBooks.logBook')->orderBy('name')->get();
        }


        return view('tourguide-driver.index', compact('TGDrivers'));
    }

    public function show($id)
    {
        $record = TourguideDriver::with('logBooks')->where('id', $id)->first();
        return view('tourguide-driver.show', compact('record'));
    }

    public function pdf()
    {
        $records = TourguideDriver::with('logBooks')->get();
        $pdf = PDF::loadView('tourguide-driver.pdf', compact('records'));
        $pdf->setPaper('letter', 'portrait');
        $pdf->setOptions(['isPhpEnabled' => true]);
        return $pdf->stream('Record.pdf');
    }

    public function edit($id)
    {
        $TGDriver = TourguideDriver::where('id', $id)->first();
        return view('tourguide-driver.edit', compact('TGDriver'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'agency' => 'required',
            'occupation' => 'required'
        ]);

        TourguideDriver::where('id', $id)->update([
            'name' => $request->name,
            'agency' => $request->agency,
            'occupation' => $request->occupation
        ]);

        return redirect('/tourguide-driver');
    }


    public function exportSummary()
    {
        return Excel::download(new SummaryExport, 'summary.xlsx');
    }

    public function delete($id)
    {
        TourguideDriver::find($id)->delete();
        return back();
    }
}
