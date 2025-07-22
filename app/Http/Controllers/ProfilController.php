<?php

namespace App\Http\Controllers;

use App\Models\About;

class ProfilController extends Controller
{
    public function tentangKami()
    {
        $about = About::current();

        return view('profil.tentang-kami', compact('about'));
    }

    public function adArt()
    {
        $about = About::current();

        return view('profil.ad-art', compact('about'));
    }

    public function panduanLogo()
    {
        $about = About::current();

        return view('profil.panduan-logo', compact('about'));
    }

    public function grandDesign()
    {
        $about = About::current();

        return view('profil.grand-design', compact('about'));
    }

    public function hutHmti()
    {
        $about = About::current();

        return view('profil.hut-hmti', compact('about'));
    }

    public function sejarah()
    {
        $about = About::current();

        return view('profil.sejarah', compact('about'));
    }
}
