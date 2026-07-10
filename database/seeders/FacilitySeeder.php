<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        $facilities = [
            [
                'category' => 'laboratorium',
                'title' => 'Ruang Laboratorium',
                'description' => 'Ruang laboratorium mendukung kegiatan praktikum, pengujian, pengukuran, simulasi, serta penerapan teknologi teknik mesin yang relevan dengan kebutuhan industri.',
                'sort_order' => 1,
            ],
            [
                'category' => 'workshop',
                'title' => 'Ruang Workshop',
                'description' => 'Ruang workshop menjadi area praktik utama mahasiswa dalam kegiatan produksi, manufaktur, perawatan, perakitan, dan penggunaan peralatan kerja teknik mesin.',
                'sort_order' => 2,
            ],
            [
                'category' => 'ruang_kelas',
                'title' => 'Ruang Kelas',
                'description' => 'Ruang kelas digunakan untuk mendukung pembelajaran teori, diskusi, presentasi, dan penguatan konsep dasar maupun terapan di bidang teknik mesin.',
                'sort_order' => 3,
            ],
            [
                'category' => 'ruang_dosen',
                'title' => 'Ruang Dosen',
                'description' => 'Ruang dosen digunakan sebagai ruang kerja, konsultasi akademik, koordinasi pembelajaran, serta pendampingan mahasiswa oleh dosen Program Studi D-III Teknik Mesin.',
                'sort_order' => 4,
            ],
            [
                'category' => 'tata_usaha',
                'title' => 'Ruang Tata Usaha',
                'description' => 'Ruang tata usaha mendukung layanan administrasi akademik, pengelolaan dokumen, pelayanan mahasiswa, serta kebutuhan operasional program studi.',
                'sort_order' => 5,
            ],
            [
                'category' => 'fasilitas_kesehatan',
                'title' => 'Fasilitas Kesehatan',
                'description' => 'Fasilitas kesehatan tersedia untuk mendukung kenyamanan, keselamatan, dan layanan kesehatan dasar bagi sivitas akademika di lingkungan kampus.',
                'sort_order' => 6,
            ],
            [
                'category' => 'masjid',
                'title' => 'Masjid',
                'description' => 'Masjid menjadi fasilitas ibadah bagi mahasiswa, dosen, tenaga kependidikan, dan masyarakat kampus dalam menunjang kegiatan spiritual di lingkungan Polinema.',
                'sort_order' => 7,
            ],
            [
                'category' => 'galeri',
                'title' => 'Galeri Aktivitas Mahasiswa',
                'description' => 'Galeri menampilkan aktivitas mahasiswa Teknik Mesin di lingkungan kampus, seperti praktikum, proyek mahasiswa, organisasi, kunjungan industri, dan kegiatan pengembangan kompetensi.',
                'sort_order' => 8,
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::updateOrCreate(
                ['category' => $facility['category']],
                $facility
            );
        }
    }
}