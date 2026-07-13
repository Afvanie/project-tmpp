<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use App\Models\HomeStatistic;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        HomeContent::updateOrCreate(
            ['section_key' => 'program_description'],
            [
                'badge' => 'Program Studi',
                'title' => 'Deskripsi Program Studi',
                'description' => 'Program Studi D-III Teknik Mesin merupakan salah satu program studi di Jurusan Teknik Mesin yang dirancang secara khusus untuk menghasilkan tenaga ahli madya yang memiliki kemampuan dalam bidang perancangan, manufaktur, pemeliharaan, dan pengembangan teknologi teknik mesin. Mahasiswa dibekali kemampuan dalam merancang mesin dan komponen mekanik, memahami proses manufaktur logam maupun non-logam, mengoperasikan teknologi CAD/CAM/CAE, serta menerapkan pengetahuan praktis dan teoritis yang relevan dengan kebutuhan industri. Lulusan juga diarahkan untuk memiliki etika kerja profesional, jiwa kepemimpinan, tanggung jawab, serta kemampuan beradaptasi terhadap perkembangan teknologi.',
                'button_text' => 'Selengkapnya',
                'button_url' => '/profile',
                'is_active' => true,
            ]
        );

        $statistics = [
            [
                'key' => 'students',
                'value' => '540',
                'label' => 'Mahasiswa',
                'sort_order' => 1,
            ],
            [
                'key' => 'lecturers',
                'value' => '65',
                'label' => 'Dosen',
                'sort_order' => 2,
            ],
            [
                'key' => 'laboratories',
                'value' => '21',
                'label' => 'Laboratorium',
                'sort_order' => 3,
            ],
            [
                'key' => 'founded',
                'value' => '1982',
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