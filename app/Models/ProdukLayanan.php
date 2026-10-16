<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProdukLayanan extends Model
{
    protected $table = 'produk_layanan';

    protected $fillable = [
        'nama',
        'slug',
        'ikon',
        'kategori',
        'harga',
        'deskripsi',
        'gambar',
        'urutan',
        'is_aktif',
    ];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->slug) || static::where('slug', $model->slug)
                ->where('id', '!=', $model->id)
                ->exists()) {
                $model->slug = static::generateUniqueSlug($model->nama, $model->id);
            }
        });
    }

    public static function generateUniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'produk';
        $slug = $base;
        $i = 1;

        while (static::where('slug', $slug)
            ->when($ignoreId, fn (Builder $q) => $q->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('is_aktif', true);
    }
}
