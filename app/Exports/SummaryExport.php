<?php

namespace App\Exports;

use App\Models\TourguideDriver;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SummaryExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.summary', [
            'data' => TourguideDriver::orderBy('name')->get(),
        ]);
    }
}
