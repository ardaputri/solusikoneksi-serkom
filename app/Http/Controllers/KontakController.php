<?php

namespace App\Http\Controllers;

use App\Models\PesanKontak;
use App\Models\ProfilPerusahaan;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function show()
    {
        $profil = ProfilPerusahaan::first();

        return view('kontak', compact('profil'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'nullable|string|max:30',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string|max:2000',
        ]);

        PesanKontak::create($validated);

        return redirect()->route('kontak.show')
            ->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera kami tanggapi.');
    }
}
