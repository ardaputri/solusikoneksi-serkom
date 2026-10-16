<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilPerusahaan;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function edit()
    {
        $profil = ProfilPerusahaan::first();

        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilPerusahaan::first();

        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'alamat' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'berdiri_sejak' => 'nullable|string|max:4',
            'maps_embed_url' => 'nullable|string',
            'facebook' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'foto' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {
            $this->hapusGambar($profil->logo);
            $validated['logo'] = $this->simpanGambar($request->file('logo'), 'profil');
        } else {
            unset($validated['logo']);
        }

        if ($request->hasFile('foto')) {
            $this->hapusGambar($profil->foto);
            $validated['foto'] = $this->simpanGambar($request->file('foto'), 'profil');
        } else {
            unset($validated['foto']);
        }

        // Profil perusahaan bersifat statis: tidak bisa ditambah, hanya diperbaharui.
        if ($profil) {
            $profil->update($validated);
        } else {
            ProfilPerusahaan::create($validated);
        }

        return redirect()->route('admin.profil.edit')
            ->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
