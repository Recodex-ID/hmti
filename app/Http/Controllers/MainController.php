<?php

namespace App\Http\Controllers;

use App\Models\CircularLetter;
use App\Models\ActivityInformation;
use App\Models\CompetitionInformation;
use App\Models\News;
use App\Models\Hero;
use App\Models\About;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Ambil data terbaru untuk homepage
        $heroes = Hero::latest()->get();
        $about = About::current();
        
        $circularLetters = CircularLetter::where('is_active', true)
            ->orderBy('letter_date', 'desc')
            ->limit(3)
            ->get();

        $activities = ActivityInformation::where('is_active', true)
            ->where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->limit(3)
            ->get();

        $competitions = CompetitionInformation::where('is_active', true)
            ->where('registration_deadline', '>=', now())
            ->orderBy('registration_deadline', 'asc')
            ->limit(3)
            ->get();

        $featuredNews = News::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->first();

        $news = News::where('is_published', true)
            ->where('is_featured', false)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('index', compact(
            'heroes',
            'about',
            'circularLetters',
            'activities', 
            'competitions',
            'featuredNews',
            'news'
        ));
    }
}
