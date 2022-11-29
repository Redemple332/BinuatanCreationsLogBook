<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\LogBook;
use App\Models\LogBookTourguideDriver;
use App\Models\TourguideDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LogBookController extends Controller
{
    public function index()
    {
        $lastLog = LogBook::with('touguideDrivers.profile')->latest()->first();
        $tourguide_drivers = TourguideDriver::with('logBooks')->select('id', 'name')->orderBy('name')->get();
        $agencies = LogBook::Agency()->get();
        return view('log-book.index', compact('tourguide_drivers', 'lastLog', 'agencies'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'amount' => 'required|integer',
            'agency' => 'required',
            'date' => 'required'
        ]);

       $personCount = count($request->name);
       $percent = 0.06;

       $share = $request->amount * $percent;
       $individual_share = $share / $personCount;

       $log_book = LogBook::create([
        'agency' => $request->agency,
        'amount' => $request->amount,
        'share' => $share,
        'individual_share' => $individual_share,
        'date' => $request->date,
        'user_id' => Auth::user()->id
       ]);

       Guest::create([
        'log_book_id' => $log_book->id,
        'children' => $request->children,
        'female' => $request->female,
        'male' => $request->male,
        'country' => $request->country ?? 'Philippines'
       ]);

       foreach($request->name as $index => $item) {
            $tourDriver = TourguideDriver::where('id',Str::before($item, ';'))->first();
            if(!$tourDriver){
               $tourDriver = TourguideDriver::create([
                    'name' => Str::after($item, ';'),
                    'agency' => $request->agency,
                    'occupation' =>  $index == 0 ? 'Driver' : 'Tourguide',
                ]);
            }

            LogBookTourguideDriver::create([
                'tourguide_driver_id' => $tourDriver->id,
                'log_book_id' => $log_book->id
            ]);
       }

       Session::flash('message', 'Saved Successfully!');
       return Redirect('/');

    }

    public function edit($id)
    {
        $lastLog = LogBook::with('touguideDrivers.profile', 'guest')->where('id', $id)->first();
        $tourguide_drivers = TourguideDriver::with('logBooks')->select('id', 'name')->orderBy('name')->get();
        $agencies = LogBook::Agency()->get();
        return view('log-book.edit', compact('tourguide_drivers', 'lastLog', 'agencies'));
    }

    public function list()
    {
        $logBooks = LogBook::with('guest')->orderBy('date', 'desc')->get();
        if($logBooks){
            return view('log-book.list', compact('logBooks'));

        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|integer',
            'agency' => 'required',
            'date' => 'required'
        ]);
       $oldLog = LogBook::where('id', $id)->first();
       $personCount = count($request->name);
       $percent = 0.06;

       $share = $request->amount * $percent;
       $individual_share = $share / $personCount;

       $log_book = LogBook::find($id)->update([
        'agency' => $request->agency,
        'amount' => $request->amount,
        'share' => $share,
        'individual_share' => $individual_share,
        'date' => $request->date,
        'user_id' => Auth::user()->id
       ]);

       Guest::where('log_book_id', $id)->update([
        'log_book_id' => $id,
        'children' => $request->children,
        'female' => $request->female,
        'male' => $request->male,
        'country' => $request->country ?? 'Philippines'
       ]);

       LogBookTourguideDriver::where('log_book_id', $id)->delete();

       foreach($request->name as $index => $item) {
            $tourDriver = TourguideDriver::where('id',Str::before($item, ';'))->first();
            if(!$tourDriver){
               $tourDriver = TourguideDriver::create([
                    'name' => Str::after($item, ';'),
                    'agency' => $request->agency,
                    'occupation' =>  $index == 0 ? 'Driver' : 'Tourguide',
                ]);
            }
            LogBookTourguideDriver::create([
                'tourguide_driver_id' => $tourDriver->id,
                'log_book_id' => $id
            ]);
       }

       Session::flash('message', 'Saved Updated!');
       return Redirect('/');
    }

    public function delete($id)
    {
        Guest::where('log_book_id',$id)->delete();
        LogBookTourguideDriver::where('log_book_id',$id)->delete();
        LogBook::find($id)->delete();

        Session::flash('message', 'Deleted Successfully!');
        return Redirect('/');
    }
}
