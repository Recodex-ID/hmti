<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartnershipController extends Controller
{
    public function benchmark()
    {
        return view('partnership.benchmark');
    }

    public function mediaPartner()
    {
        return view('partnership.media-partner');
    }

    public function mcModerator()
    {
        return view('partnership.mc-moderator');
    }
}
