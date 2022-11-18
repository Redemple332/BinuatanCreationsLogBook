<?php

namespace App\Http\Controllers;

use App\Models\LogBook;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function index()
    {
        $agencies = LogBook::Agency()->get();

        return view('Agency.index', compact('agencies'));
    }
}
