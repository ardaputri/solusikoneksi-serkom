<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;

abstract class Controller
{
    /**
     * Simpan upload gambar ke public/uploads/{subfolder} dan kembalikan nama filenya.
     */
    protected function simpanGambar(?UploadedFile $file, string $subfolder): ?string
    {
        if (! $file) {
            return null;
        }

        $nama = date('Ymd_His').'_'.bin2hex(random_bytes(4)).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/'.$subfolder), $nama);

        return 'uploads/'.$subfolder.'/'.$nama;
    }

    /**
     * Hapus file gambar lama dari disk (abaikan jika bukan file upload kita).
     */
    protected function hapusGambar(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/')) {
            $full = public_path($path);
            if (file_exists($full)) {
                @unlink($full);
            }
        }
    }
}
