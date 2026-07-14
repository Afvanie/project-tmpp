<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Membuat struktur awal kategori fasilitas TMPP.
     *
     * Deskripsi sengaja dikosongkan karena materi resmi yang tersedia
     * belum memberikan uraian khusus untuk setiap fasilitas.
     * Pengelola dapat melengkapinya melalui halaman admin.
     */
    public function run(): void
    {
        $facilities = [
            [
                'category' =>
                    Facility::CATEGORY_LABORATORY,

                'title' =>
                    'Ruang Laboratorium',

                'description' =>
                    null,

                'sort_order' =>
                    1,

                'is_active' =>
                    true,
            ],

            [
                'category' =>
                    Facility::CATEGORY_WORKSHOP,

                'title' =>
                    'Ruang Workshop',

                'description' =>
                    null,

                'sort_order' =>
                    2,

                'is_active' =>
                    true,
            ],

            [
                'category' =>
                    Facility::CATEGORY_CLASSROOM,

                'title' =>
                    'Ruang Kelas',

                'description' =>
                    null,

                'sort_order' =>
                    3,

                'is_active' =>
                    true,
            ],

            [
                'category' =>
                    Facility::CATEGORY_GALLERY,

                'title' =>
                    'Galeri Aktivitas Mahasiswa',

                'description' =>
                    null,

                'sort_order' =>
                    4,

                'is_active' =>
                    true,
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::query()->updateOrCreate(
                [
                    'category' => $facility['category'],
                ],
                [
                    'title' => $facility['title'],
                    'description' => $facility['description'],
                    'sort_order' => $facility['sort_order'],
                    'is_active' => $facility['is_active'],
                ]
            );
        }
    }
}