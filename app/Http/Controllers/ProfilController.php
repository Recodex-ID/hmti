<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function tentangKami()
    {
        return view('profil.tentang-kami');
    }

    public function adArt()
    {
        return view('profil.ad-art');
    }

    public function panduanLogo()
    {
        return view('profil.panduan-logo');
    }

    public function grandDesign()
    {
        return view('profil.grand-design');
    }

    public function hutHmti()
    {
        return view('profil.hut-hmti');
    }

    public function sejarah()
    {
        return view('profil.sejarah');
    }
}
