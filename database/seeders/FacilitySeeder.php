<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Membuat struktur awal fasilitas TMPP.
     *
     * Seeder tidak mengubah deskripsi fasilitas yang sudah
     * dilengkapi melalui admin dan tidak menghapus foto.
     */
    public function run(): void
    {
        $facilities = [
            [
                'category' =>
                    Facility::CATEGORY_LABORATORY,

                'title' =>
                    'Ruang Laboratorium',

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

                'sort_order' =>
                    3,

                'is_active' =>
                    true,
            ],

            [
                'category' =>
                    Facility::CATEGORY_LECTURER_ROOM,

                'title' =>
                    'Ruang Dosen',

                'sort_order' =>
                    4,

                'is_active' =>
                    true,
            ],

            [
                'category' =>
                    Facility::CATEGORY_ADMINISTRATION,

                'title' =>
                    'Ruang Tata Usaha',

                'sort_order' =>
                    5,

                'is_active' =>
                    true,
            ],

            [
                'category' =>
                    Facility::CATEGORY_HEALTH,

                'title' =>
                    'Fasilitas Kesehatan',

                'sort_order' =>
                    6,

                'is_active' =>
                    true,
            ],

            [
                'category' =>
                    Facility::CATEGORY_MOSQUE,

                'title' =>
                    'Masjid',

                'sort_order' =>
                    7,

                'is_active' =>
                    true,
            ],

            [
                'category' =>
                    Facility::CATEGORY_GALLERY,

                'title' =>
                    'Galeri Aktivitas Mahasiswa',

                'sort_order' =>
                    8,

                'is_active' =>
                    true,
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::query()->updateOrCreate(
                [
                    'category' =>
                        $facility['category'],
                ],
                [
                    'title' =>
                        $facility['title'],

                    'sort_order' =>
                        $facility['sort_order'],

                    'is_active' =>
                        $facility['is_active'],
                ]
            );
        }
    }
}