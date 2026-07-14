<?php

namespace Database\Seeders;

use App\Models\ProfileSection;
use Illuminate\Database\Seeder;

class ProfileOverviewSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | PROFIL SINGKAT PROGRAM STUDI
        |--------------------------------------------------------------------------
        */

        $section = ProfileSection::updateOrCreate(
            [
                'slug' => 'overview',
            ],
            [
                'subtitle' => 'TENTANG KAMI',
                'title' => 'Mengenal Program Studi D-IV Teknik Mesin Produksi dan Perawatan',
                'description' => 'Pendidikan vokasi Sarjana Terapan yang berorientasi pada bidang produksi, manufaktur, perawatan mesin, dan kebutuhan industri.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | KOSONGKAN ITEM SEBELUM MEMASUKKAN MATERI TMPP
        |--------------------------------------------------------------------------
        */

        $section->items()->delete();

        /*
        |--------------------------------------------------------------------------
        | MATERI PROFIL SINGKAT TMPP
        |--------------------------------------------------------------------------
        */

        $section->items()->createMany([
            [
                'item_group' => 'label',
                'title' => 'Label Konten',
                'content' => 'PROFIL SINGKAT',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'paragraph',
                'title' => null,
                'content' => 'Program Studi D-IV Teknik Mesin Produksi dan Perawatan merupakan program pendidikan vokasi di bawah Jurusan Teknik Mesin Politeknik Negeri Malang yang mempersiapkan lulusan Sarjana Terapan dengan kompetensi dalam bidang produksi, manufaktur, dan perawatan mesin.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'paragraph',
                'title' => null,
                'content' => 'Program studi ini dikembangkan untuk menjawab kebutuhan dunia kerja terhadap lulusan setara sarjana yang tidak hanya memiliki kemampuan akademik, tetapi juga keterampilan teknis dan kemampuan praktis yang sesuai dengan perkembangan industri.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'paragraph',
                'title' => null,
                'content' => 'Proses pembelajaran menerapkan pendekatan Outcome-Based Education yang berorientasi pada pencapaian kompetensi lulusan yang jelas, terukur, dan selaras dengan kebutuhan industri. Mahasiswa diarahkan untuk menguasai kompetensi teknis, kemampuan berpikir kritis, komunikasi, kerja sama tim, serta kemampuan beradaptasi terhadap perkembangan teknologi.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'item_group' => 'paragraph',
                'title' => null,
                'content' => 'Kurikulum Program Studi D-IV Teknik Mesin Produksi dan Perawatan memiliki total beban pendidikan 152 SKS yang terdiri atas 37 SKS teori dan 115 SKS praktik. Komposisi praktik sebesar 76 persen memperkuat karakter pendidikan vokasi dalam bidang proses produksi, manufaktur, perawatan mesin, otomasi industri, quality control, autonomous maintenance, dan continuous improvement.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'item_group' => 'paragraph',
                'title' => null,
                'content' => 'Sebagai bentuk komitmen terhadap mutu pendidikan, Program Studi D-IV Teknik Mesin Produksi dan Perawatan memperoleh akreditasi A dari Lembaga Akreditasi Mandiri Teknik pada tahun 2022. Program studi terus melakukan evaluasi dan pengembangan kurikulum agar tetap relevan dengan perkembangan ilmu pengetahuan, teknologi, serta kebutuhan dunia usaha dan dunia industri.',
                'sort_order' => 5,
                'is_active' => true,
            ],

            /*
            |--------------------------------------------------------------------------
            | KARTU INFORMASI
            |--------------------------------------------------------------------------
            */

            [
                'item_group' => 'info_card',
                'title' => 'Jenjang Pendidikan',
                'content' => 'D-IV|Program Diploma Empat jenjang Sarjana Terapan dan KKNI Level 6.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'info_card',
                'title' => 'Akreditasi',
                'content' => 'A|Memperoleh akreditasi A dari LAM Teknik pada tahun 2022.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'info_card',
                'title' => 'Gelar Lulusan',
                'content' => '|',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'item_group' => 'info_card',
                'title' => 'Masa Studi',
                'content' => '8 Semester|Kurikulum disusun untuk delapan semester dengan total 152 SKS.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ]);
    }
}