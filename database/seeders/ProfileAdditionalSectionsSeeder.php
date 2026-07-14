<?php

namespace Database\Seeders;

use App\Models\ProfileItem;
use App\Models\ProfileSection;
use Illuminate\Database\Seeder;

class ProfileAdditionalSectionsSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | CATATAN
        |--------------------------------------------------------------------------
        |
        | Seeder ini hanya mengelola:
        |
        | 1. Profil Singkat / Overview
        | 2. Sejarah Program Studi
        |
        | Bagian berikut dikelola oleh ProfileContentSeeder:
        |
        | - visi-misi
        | - tujuan-prodi
        | - ppm
        | - cpl
        |
        | Jangan melakukan penghapusan semua section dengan whereNotIn(),
        | karena dapat menghapus section yang dikelola oleh seeder lain.
        |
        */

        /*
        |--------------------------------------------------------------------------
        | PROFIL SINGKAT / OVERVIEW
        |--------------------------------------------------------------------------
        */

        $overview = ProfileSection::updateOrCreate(
            ['slug' => 'overview'],
            [
                'subtitle' => 'Profil Program Studi',
                'title' => 'D-IV Teknik Mesin Produksi dan Perawatan',
                'description' => 'Program Studi D-IV Teknik Mesin Produksi dan Perawatan merupakan program pendidikan vokasi di Jurusan Teknik Mesin Politeknik Negeri Malang yang mempersiapkan lulusan Sarjana Terapan dengan kompetensi pada bidang produksi, manufaktur, dan perawatan mesin.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | HAPUS MATERI OVERVIEW LAMA D-III
        |--------------------------------------------------------------------------
        */

        $overview->items()->delete();

        /*
        |--------------------------------------------------------------------------
        | MASUKKAN MATERI OVERVIEW TMPP
        |--------------------------------------------------------------------------
        */

        $overview->items()->createMany([
            [
                'item_group' => 'overview',
                'title' => 'Pendidikan Vokasi Sarjana Terapan',
                'content' => 'Program Studi D-IV Teknik Mesin Produksi dan Perawatan menyelenggarakan pendidikan vokasi jenjang Sarjana Terapan yang membekali mahasiswa dengan kemampuan akademik dan keterampilan praktis sesuai kebutuhan dunia industri.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'overview',
                'title' => 'Bidang Produksi dan Perawatan',
                'content' => 'Pembelajaran diarahkan pada penguasaan proses produksi, manufaktur, perancangan teknik, pengoperasian mesin, quality control, otomasi industri, troubleshooting, serta perawatan mesin industri.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'overview',
                'title' => 'Outcome-Based Education',
                'content' => 'Kurikulum Program Studi D-IV Teknik Mesin Produksi dan Perawatan menerapkan pendekatan Outcome-Based Education yang berorientasi pada capaian pembelajaran yang jelas, terukur, dan relevan dengan kebutuhan industri.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'item_group' => 'overview',
                'title' => 'Autonomous Maintenance',
                'content' => 'Program studi mengembangkan kompetensi autonomous maintenance, preventive maintenance, corrective maintenance, troubleshooting, lean manufacturing, quality control, dan continuous improvement untuk mendukung peningkatan keandalan mesin serta produktivitas industri.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEJARAH PROGRAM STUDI
        |--------------------------------------------------------------------------
        |
        | Buku Kurikulum D-IV TMPP 2025/2026 memuat latar belakang
        | pengembangan program studi, tetapi belum memberikan kronologi
        | sejarah resmi yang lengkap.
        |
        | Section tetap dipertahankan, tetapi materinya dikosongkan agar
        | dapat diisi oleh pengelola melalui halaman admin.
        |
        */

        $history = ProfileSection::updateOrCreate(
            ['slug' => 'history'],
            [
                'subtitle' => 'Sejarah Program Studi',
                'title' => 'Perjalanan D-IV TMPP',
                'description' => null,
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | KOSONGKAN SEJARAH LAMA D-III
        |--------------------------------------------------------------------------
        */

        $history->items()->delete();

        /*
        |--------------------------------------------------------------------------
        | NONAKTIFKAN SECTION DUPLIKAT LAMA
        |--------------------------------------------------------------------------
        |
        | Section vision-mission dan goals merupakan versi lama dengan slug
        | bahasa Inggris. Materi resminya sekarang dikelola menggunakan:
        |
        | - visi-misi
        | - tujuan-prodi
        |
        | Section lama tidak dihapus agar struktur database tetap aman,
        | tetapi dinonaktifkan dan materinya dibersihkan.
        |
        */

        $legacySlugs = [
            'vision-mission',
            'goals',
        ];

        $legacySections = ProfileSection::query()
            ->whereIn('slug', $legacySlugs)
            ->get();

        foreach ($legacySections as $legacySection) {
            $legacySection->items()->delete();

            $legacySection->update([
                'is_active' => false,
            ]);
        }
    }
}