<?php

namespace App\Http\Controllers;

use App\Models\Mpm;

class MpmController extends Controller
{
    public function komisiA()
    {
        $mpm = Mpm::getByType('komisi-a');
        return view('mpm.komisi-a', compact('mpm'));
    }

    public function komisiB()
    {
        $mpm = Mpm::getByType('komisi-b');
        return view('mpm.komisi-b', compact('mpm'));
    }

    public function komisiC()
    {
        $mpm = Mpm::getByType('komisi-c');
        return view('mpm.komisi-c', compact('mpm'));
    }

    public function burt()
    {
        $mpm = Mpm::getByType('burt');
        return view('mpm.burt', compact('mpm'));
    }
}
