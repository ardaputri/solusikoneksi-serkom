<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPerusahaan extends Model
{
    protected $table = 'profil_perusahaan';

    protected $fillable = [
        'nama_perusahaan',
        'tagline',
        'deskripsi',
        'visi',
        'misi',
        'alamat',
        'telepon',
        'email',
        'website',
        'berdiri_sejak',
        'logo',
        'foto',
        'maps_embed_url',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'jam_operasional',
    ];
}
