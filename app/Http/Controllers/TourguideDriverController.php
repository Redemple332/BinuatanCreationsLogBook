<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourguideDriverController extends Controller
{
    public function index()
    {
        return view('tourguide-driver.index');
    }
}
