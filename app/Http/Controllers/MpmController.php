<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpmController extends Controller
{
    public function komisiA()
    {
        return view('mpm.komisi-a');
    }

    public function komisiB()
    {
        return view('mpm.komisi-b');
    }

    public function komisiC()
    {
        return view('mpm.komisi-c');
    }

    public function burt()
    {
        return view('mpm.burt');
    }
}
