<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use App\Models\HomeStatistic;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | DESKRIPSI PROGRAM STUDI
        |--------------------------------------------------------------------------
        */

        HomeContent::updateOrCreate(
            ['section_key' => 'program_description'],
            [
                'badge' => 'Program Studi',
                'title' => 'Deskripsi Program Studi',
                'description' => 'Program Studi D-IV Teknik Mesin Produksi dan Perawatan merupakan program pendidikan vokasi di Jurusan Teknik Mesin Politeknik Negeri Malang yang mempersiapkan lulusan Sarjana Terapan dengan kompetensi dalam bidang produksi, manufaktur, dan perawatan mesin. Proses pembelajaran dilaksanakan melalui pendekatan Outcome-Based Education (OBE) yang berorientasi pada pencapaian kompetensi lulusan sesuai kebutuhan industri. Mahasiswa dibekali kemampuan dalam proses manufaktur, pengoperasian mesin produksi, perancangan dan analisis teknik, CAD/CAM/CAE, CNC, otomasi industri, quality control, troubleshooting, preventive maintenance, autonomous maintenance, serta continuous improvement. Lulusan juga diarahkan untuk memiliki kemampuan komunikasi, kepemimpinan, kerja sama tim, etika profesi, jiwa technopreneur, dan kemampuan beradaptasi terhadap perkembangan teknologi industri.',
                'button_text' => 'Selengkapnya',
                'button_url' => '/profile',
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | STATISTIK PROGRAM STUDI
        |--------------------------------------------------------------------------
        |
        | Data resmi jumlah mahasiswa, dosen, laboratorium, dan tahun berdiri
        | belum tersedia dalam dokumen yang diberikan.
        |
        | Struktur statistik tetap dipertahankan, tetapi nilainya dikosongkan
        | agar nantinya dapat dilengkapi oleh pengelola melalui halaman admin.
        |
        */

        $statistics = [
            [
                'key' => 'students',
                'value' => '',
                'label' => 'Mahasiswa',
                'sort_order' => 1,
            ],
            [
                'key' => 'lecturers',
                'value' => '',
                'label' => 'Dosen',
                'sort_order' => 2,
            ],
            [
                'key' => 'laboratories',
                'value' => '',
                'label' => 'Laboratorium',
                'sort_order' => 3,
            ],
            [
                'key' => 'founded',
                'value' => '',
                'label' => 'Tahun Berdiri',
                'sort_order' => 4,
            ],
        ];

        foreach ($statistics as $statistic) {
            HomeStatistic::updateOrCreate(
                ['key' => $statistic['key']],
                $statistic
            );
        }
    }
}