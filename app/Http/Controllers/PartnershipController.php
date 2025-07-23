<?php

namespace App\Http\Controllers;

use App\Models\Partnership;

class PartnershipController extends Controller
{
    public function benchmark()
    {
        $partnership = Partnership::getByType('benchmark');

        return view('partnership.benchmark', compact('partnership'));
    }

    public function mediaPartner()
    {
        $partnership = Partnership::getByType('media_partner');

        return view('partnership.media-partner', compact('partnership'));
    }

    public function mcModerator()
    {
        $partnership = Partnership::getByType('mc_moderator');

        return view('partnership.mc-moderator', compact('partnership'));
    }
}
