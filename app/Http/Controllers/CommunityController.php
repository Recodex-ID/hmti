<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function show(Community $community)
    {
        return view('community.show', compact('community'));
    }
}
