<?php

namespace App\Http\Controllers;

use App\Models\ProfilPerusahaan;

class ProfilController extends Controller
{
    public function show()
    {
        $profil = ProfilPerusahaan::first();

        return view('profil', compact('profil'));
    }
}
