<?php

namespace Database\Seeders;

use App\Models\ProfileSection;
use Illuminate\Database\Seeder;

class ProfileHistorySeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | SEJARAH PROGRAM STUDI
        |--------------------------------------------------------------------------
        |
        | Materi sejarah resmi Program Studi D-IV Teknik Mesin Produksi
        | dan Perawatan belum tersedia secara lengkap dalam dokumen
        | kurikulum yang diberikan.
        |
        | Section tetap dibuat agar nantinya dapat diisi oleh pengelola
        | melalui halaman admin.
        |
        */

        $section = ProfileSection::updateOrCreate(
            [
                'slug' => 'history',
            ],
            [
                'subtitle' => 'Perjalanan Program Studi',
                'title' => 'Sejarah Program Studi',
                'description' => null,
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | KOSONGKAN ITEM SEJARAH
        |--------------------------------------------------------------------------
        |
        | Tidak memasukkan paragraf, timeline, tahun pendirian,
        | maupun informasi akreditasi yang belum memiliki sumber resmi.
        |
        */

        $section->items()->delete();
    }
}