<?php

namespace App\Http\Controllers;

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
