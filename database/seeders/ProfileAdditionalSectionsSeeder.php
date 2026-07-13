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
        | VISI MISI
        |--------------------------------------------------------------------------
        */

        $visionMission = ProfileSection::updateOrCreate(
            ['slug' => 'vision-mission'],
            [
                'subtitle' => 'Visi dan Misi',
                'title' => 'Arah Pengembangan Program Studi',
                'description' => 'Visi dan misi Program Studi D-III Teknik Mesin menjadi dasar penyelenggaraan pendidikan vokasi yang unggul, relevan dengan kebutuhan industri, dan berorientasi pada pengembangan kompetensi lulusan.',
                'sort_order' => 3,
                'is_active' => true,
            ]
        );

        $visionMissionItems = [
            [
                'item_group' => 'visi',
                'title' => 'Visi Program Studi',
                'content' => 'Menjadi program studi vokasi yang unggul dalam bidang teknik mesin, berorientasi pada kebutuhan industri, perkembangan teknologi, dan menghasilkan lulusan yang profesional serta berdaya saing.',
                'sort_order' => 1,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 1',
                'content' => 'Menyelenggarakan pendidikan vokasi bidang teknik mesin yang berkualitas, berbasis praktik, dan relevan dengan kebutuhan industri.',
                'sort_order' => 1,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 2',
                'content' => 'Mengembangkan pembelajaran, penelitian terapan, dan pengabdian kepada masyarakat yang mendukung penguatan kompetensi teknik mesin.',
                'sort_order' => 2,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 3',
                'content' => 'Membangun kerja sama dengan dunia usaha, dunia industri, institusi pendidikan, dan pemangku kepentingan lainnya dalam pengembangan pendidikan vokasi.',
                'sort_order' => 3,
            ],
        ];

        foreach ($visionMissionItems as $item) {
            ProfileItem::updateOrCreate(
                [
                    'profile_section_id' => $visionMission->id,
                    'item_group' => $item['item_group'],
                    'sort_order' => $item['sort_order'],
                ],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'is_active' => true,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | TUJUAN PROGRAM STUDI
        |--------------------------------------------------------------------------
        */

        $goals = ProfileSection::updateOrCreate(
            ['slug' => 'goals'],
            [
                'subtitle' => 'Tujuan Program Studi',
                'title' => 'Tujuan Pendidikan Program Studi',
                'description' => 'Tujuan Program Studi D-III Teknik Mesin disusun untuk menghasilkan lulusan yang memiliki kompetensi teknis, profesionalisme, dan kesiapan menghadapi kebutuhan dunia kerja.',
                'sort_order' => 4,
                'is_active' => true,
            ]
        );

        $goalItems = [
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 1',
                'content' => 'Menghasilkan lulusan ahli madya yang memiliki kompetensi dalam bidang teknik mesin, proses manufaktur, perawatan, perbaikan, dan penerapan teknologi industri.',
                'sort_order' => 1,
            ],
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 2',
                'content' => 'Menghasilkan lulusan yang mampu bekerja secara profesional, disiplin, bertanggung jawab, beretika, dan mampu beradaptasi dengan perkembangan teknologi.',
                'sort_order' => 2,
            ],
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 3',
                'content' => 'Mengembangkan pendidikan vokasi yang selaras dengan kebutuhan industri dan mendukung peningkatan daya saing lulusan.',
                'sort_order' => 3,
            ],
        ];

        foreach ($goalItems as $item) {
            ProfileItem::updateOrCreate(
                [
                    'profile_section_id' => $goals->id,
                    'item_group' => $item['item_group'],
                    'sort_order' => $item['sort_order'],
                ],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'is_active' => true,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | PROFIL PROFESIONAL MANDIRI / PPM
        |--------------------------------------------------------------------------
        */

        $ppm = ProfileSection::updateOrCreate(
            ['slug' => 'ppm'],
            [
                'subtitle' => 'Profil Profesional Mandiri',
                'title' => 'Profil Profesional Mandiri Lulusan',
                'description' => 'Profil Profesional Mandiri menggambarkan karakter, kompetensi, dan kemampuan lulusan Program Studi D-III Teknik Mesin setelah menyelesaikan pendidikan.',
                'sort_order' => 5,
                'is_active' => true,
            ]
        );

        $ppmItems = [
            [
                'item_group' => 'ppm',
                'title' => 'Profesional Beretika',
                'content' => 'Profesional yang memiliki sikap dan etika yang baik serta menjunjung tinggi nilai kemanusiaan berdasar agama, moral, dan Pancasila.',
                'sort_order' => 1,
            ],
            [
                'item_group' => 'ppm',
                'title' => 'Profesional Bidang Teknik Mesin',
                'content' => 'Profesional yang mampu berkontribusi secara aktif dan inovatif sebagai ahli madya di bidang teknik mesin, manufaktur, perawatan, dan proses produksi.',
                'sort_order' => 2,
            ],
            [
                'item_group' => 'ppm',
                'title' => 'Adaptif dan Kreatif',
                'content' => 'Profesional yang mampu berpikir kreatif, memecahkan masalah, beradaptasi dengan perkembangan teknologi, dan mengembangkan diri secara berkelanjutan.',
                'sort_order' => 3,
            ],
        ];

        foreach ($ppmItems as $item) {
            ProfileItem::updateOrCreate(
                [
                    'profile_section_id' => $ppm->id,
                    'item_group' => $item['item_group'],
                    'sort_order' => $item['sort_order'],
                ],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'is_active' => true,
                ]
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CAPAIAN PEMBELAJARAN LULUSAN / CPL
        |--------------------------------------------------------------------------
        */

        $cpl = ProfileSection::updateOrCreate(
            ['slug' => 'cpl'],
            [
                'subtitle' => 'Capaian Pembelajaran Lulusan',
                'title' => 'Capaian Pembelajaran Lulusan',
                'description' => 'Capaian Pembelajaran Lulusan menjelaskan kemampuan yang harus dimiliki mahasiswa setelah menyelesaikan pendidikan di Program Studi D-III Teknik Mesin.',
                'sort_order' => 6,
                'is_active' => true,
            ]
        );

        $cplItems = [
            [
                'item_group' => 'cpl',
                'title' => 'CPL 1',
                'content' => 'Lulusan mampu menerapkan pengetahuan matematika, ilmu pengetahuan alam, dasar-dasar teknik, dan teknologi yang relevan dalam bidang teknik mesin.',
                'sort_order' => 1,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 2',
                'content' => 'Lulusan mampu menggunakan alat ukur, alat uji, peralatan bengkel, dan perangkat lunak pendukung dalam menyelesaikan pekerjaan bidang teknik mesin.',
                'sort_order' => 2,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 3',
                'content' => 'Lulusan mampu mengidentifikasi, menganalisis, dan menyelesaikan permasalahan teknis dalam proses manufaktur, perawatan, perbaikan, dan produksi.',
                'sort_order' => 3,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 4',
                'content' => 'Lulusan mampu menerapkan prinsip keselamatan dan kesehatan kerja dalam kegiatan laboratorium, bengkel, dan lingkungan industri.',
                'sort_order' => 4,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 5',
                'content' => 'Lulusan mampu bekerja sama dalam tim, berkomunikasi secara efektif, bertanggung jawab, dan menjunjung tinggi etika profesi.',
                'sort_order' => 5,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 6',
                'content' => 'Lulusan mampu beradaptasi dengan perkembangan teknologi industri dan melakukan pengembangan diri secara berkelanjutan.',
                'sort_order' => 6,
            ],
        ];

        foreach ($cplItems as $item) {
            ProfileItem::updateOrCreate(
                [
                    'profile_section_id' => $cpl->id,
                    'item_group' => $item['item_group'],
                    'sort_order' => $item['sort_order'],
                ],
                [
                    'title' => $item['title'],
                    'content' => $item['content'],
                    'is_active' => true,
                ]
            );
        }
    }
}