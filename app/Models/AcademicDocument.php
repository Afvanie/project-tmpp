<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicDocument extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'file_path',
        'external_link',
        'academic_year',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Daftar kategori dokumen akademik.
     *
     * Nilai sebelah kiri disimpan di database.
     * Nilai sebelah kanan ditampilkan kepada pengguna.
     */
    public static function categories(): array
    {
        return [
            'pedoman_akademik' => 'Pedoman Akademik',
            'kalender_akademik' => 'Kalender Akademik',
            'kurikulum' => 'Kurikulum',
            'jadwal_kuliah' => 'Jadwal Kuliah',
            'laporan_ketercapaian' => 'Laporan Ketercapaian',
            'panduan_laporan_tugas_akhir' => 'Panduan Laporan Tugas Akhir',

            /*
            |--------------------------------------------------------------------------
            | Magang Industri
            |--------------------------------------------------------------------------
            |
            | Key lama tetap digunakan agar kompatibel dengan database dan
            | dokumen yang sudah menggunakan kategori panduan_laporan_pkl.
            |
            */

            'panduan_laporan_pkl' => 'Panduan Magang Industri',
        ];
    }

    /**
     * Mendapatkan label kategori untuk ditampilkan.
     */
    public function getCategoryLabelAttribute(): string
    {
        return self::categories()[$this->category]
            ?? str($this->category)
                ->replace('_', ' ')
                ->title()
                ->toString();
    }
}