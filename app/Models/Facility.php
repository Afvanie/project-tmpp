<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    protected $fillable = [
        'category',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    public function photos(): HasMany
    {
        return $this->hasMany(FacilityPhoto::class)->orderBy('sort_order');
    }

    public static function categories(): array
    {
        return [
            'laboratorium' => 'Ruang Laboratorium',
            'workshop' => 'Ruang Workshop',
            'ruang_kelas' => 'Ruang Kelas',
            'ruang_dosen' => 'Ruang Dosen',
            'tata_usaha' => 'Ruang Tata Usaha',
            'fasilitas_kesehatan' => 'Fasilitas Kesehatan',
            'masjid' => 'Masjid',
            'galeri' => 'Galeri Aktivitas Mahasiswa',
        ];
    }
}