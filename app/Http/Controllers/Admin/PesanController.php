<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;

class PesanController extends Controller
{
    public function index()
    {
        $pesan = PesanKontak::latest()->paginate(10);

        return view('admin.pesan.index', compact('pesan'));
    }

    public function show(PesanKontak $pesan)
    {
        if (! $pesan->is_dibaca) {
            $pesan->update(['is_dibaca' => true]);
        }

        return view('admin.pesan.show', compact('pesan'));
    }

    public function destroy(PesanKontak $pesan)
    {
        $pesan->delete();

        return redirect()->route('admin.pesan.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}
