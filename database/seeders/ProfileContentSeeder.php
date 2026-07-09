<?php

namespace Database\Seeders;

use App\Models\ProfileSection;
use Illuminate\Database\Seeder;

class ProfileContentSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | VISI MISI
        |--------------------------------------------------------------------------
        */
        $visiMisi = ProfileSection::updateOrCreate(
            ['slug' => 'visi-misi'],
            [
                'title' => 'Visi dan Misi',
                'subtitle' => 'Arah Pengembangan Program Studi',
                'description' => 'Visi dan misi Program Studi D-III Teknik Mesin Politeknik Negeri Malang.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        $visiMisi->items()->delete();

        $visiMisi->items()->createMany([
            [
                'item_group' => 'visi',
                'title' => 'Visi',
                'content' => 'Menjadi Program Studi Diploma-III Teknik Mesin Bidang Produksi-Manufaktur dan Perawatan Yang Unggul Dalam Persaingan Global 2045.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 1',
                'content' => 'Menyelenggarakan dan mengembangkan proses belajar-mengajar yang berkualitas dan inovatif di bidang Teknik Mesin sesuai kebutuhan industri, lembaga pemerintah, dan masyarakat.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 2',
                'content' => 'Melaksanakan penelitian terapan dan pengabdian kepada masyarakat serta mengembangkan penguasaan teknologi untuk memecahkan masalah di bidang pelayanan Teknik Mesin khususnya yang berkaitan dengan produksi-manufaktur dan perawatan.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 3',
                'content' => 'Meningkatkan tata kelola mutu Sumber Daya Manusia dengan mengembangkan suasana akademik yang kondusif dan mengimplementasikan nilai etika dan moral akademis.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 4',
                'content' => 'Memperluas kerjasama dengan industri dalam menghasilkan lulusan yang sesuai dengan kompetensi industri dan menumbuhkan jiwa teknopreneur.',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | TUJUAN PROGRAM STUDI
        |--------------------------------------------------------------------------
        */
        $tujuan = ProfileSection::updateOrCreate(
            ['slug' => 'tujuan-prodi'],
            [
                'title' => 'Tujuan Program Studi',
                'subtitle' => 'Sasaran Penyelenggaraan Pendidikan',
                'description' => 'Tujuan penyelenggaraan Program Studi D-III Teknik Mesin.',
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        $tujuan->items()->delete();

        $tujuan->items()->createMany([
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 1',
                'content' => 'Menghasilkan lulusan profesional berwawasan terbuka yang mampu bersaing di pasar nasional dan global bidang teknik mesin dengan menyediakan lingkungan yang kondusif.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 2',
                'content' => 'Menghasilkan lulusan yang memiliki kompetensi sebagai Teknisi Manufaktur dan perawatan dan perbaikan level 5 KKNI yang mampu menyelesaikan pekerjaan berlingkup luas dan spesifik di bidangnya, serta mampu menunjukkan kinerja dengan kualitas dan kuantitas yang terukur.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 3',
                'content' => 'Menghasilkan lulusan dengan kemampuan konsep teoritis dan praktis pada tingkat operasional bidang desain, manufaktur, produksi, instalasi, perawatan dan perbaikan.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 4',
                'content' => 'Menghasilkan lulusan dengan kemampuan praktis dalam pemanfaatan teknologi perangkat lunak aplikasi teknik modern sebagai alat bantu menyelesaikan permasalahan teknik dan manajemen.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 5',
                'content' => 'Menghasilkan lulusan dengan kemampuan komunikasi efektif dalam bahasa Indonesia dan Bahasa Inggris dalam bidang teknik maupun umum.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 6',
                'content' => 'Menghasilkan produk karya ilmiah, publikasi karya ilmiah, paten/HAKI, dan teknologi tepat guna, serta jasa bidang teknik mesin yang mampu bersaing di pasar nasional dan global.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'item_group' => 'tujuan',
                'title' => 'Tujuan 7',
                'content' => 'Menghasilkan peningkatan kualifikasi dan kompetensi Sumber Daya Manusia pada unit kerja Program Studi D-III Teknik Mesin.',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | PPM / PROFIL PROFESIONAL MANDIRI
        |--------------------------------------------------------------------------
        */
        $ppm = ProfileSection::updateOrCreate(
            ['slug' => 'ppm'],
            [
                'title' => 'Profil Profesional Mandiri',
                'subtitle' => 'Profil Lulusan Program Studi',
                'description' => 'Profil profesional lulusan Program Studi D-III Teknik Mesin.',
                'sort_order' => 3,
                'is_active' => true,
            ]
        );

        $ppm->items()->delete();

        $ppm->items()->createMany([
            [
                'item_group' => 'ppm',
                'title' => 'Professional Accomplishment',
                'content' => 'Profesional yang mampu berkarier sebagai teknisi tingkat madya pada bidang produksi/manufaktur atau perawatan/perbaikan mekanik sesuai konsentrasinya, dengan kemampuan melaksanakan, mengendalikan, mendokumentasikan, dan mengevaluasi pekerjaan teknis berdasarkan standar industri, prosedur mutu, keselamatan dan kesehatan kerja (K3), serta kode praktik yang relevan.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'ppm',
                'title' => 'Academic Accomplishment',
                'content' => 'Profesional yang mampu menerapkan dan mengembangkan pengetahuan teknik terapan, data pengukuran, metode terstandarisasi, perangkat modern, serta prinsip pemecahan masalah teknis untuk menyelesaikan persoalan teknik yang terdefinisi dengan baik pada bidang produksi atau perawatan mekanik, serta mampu memperbarui kompetensi profesional melalui pembelajaran berkelanjutan.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'ppm',
                'title' => 'General/Social Accomplishment',
                'content' => 'Profesional yang menunjukkan tanggung jawab profesional, etika kerja, kepatuhan terhadap hukum dan prosedur keselamatan, kemampuan komunikasi teknis, serta kemampuan bekerja secara mandiri maupun dalam tim yang beragam, inklusif, dan multidisiplin dengan memperhatikan mutu, efisiensi, keberlanjutan, dan dampak sosial pekerjaannya.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CPL / CAPAIAN PEMBELAJARAN LULUSAN
        |--------------------------------------------------------------------------
        */
        $cpl = ProfileSection::updateOrCreate(
            ['slug' => 'cpl'],
            [
                'title' => 'Capaian Pembelajaran Lulusan',
                'subtitle' => 'Kompetensi Lulusan D-III Teknik Mesin',
                'description' => 'Capaian Pembelajaran Lulusan Program Studi D-III Teknik Mesin jenjang Ahli Madya.',
                'sort_order' => 4,
                'is_active' => true,
            ]
        );

        $cpl->items()->delete();

        $cpl->items()->createMany([
            [
                'item_group' => 'cpl',
                'title' => 'CPL 1',
                'content' => 'Mampu menerapkan nilai moral, etika, kerjasama, dan prinsip manajemen dasar dalam kehidupan akademik dan pekerjaan teknis secara bertanggung jawab.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 2',
                'content' => 'Mampu menerapkan matematika, ilmu pengetahuan alam, dan pengetahuan dasar teknik mesin dalam penyelesaian masalah teknik yang telah dikenal baik pada bidang produksi atau perawatan.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 3',
                'content' => 'Mampu mengidentifikasi dan menganalisis masalah rekayasa yang telah dikenal baik pada bidang produksi atau perawatan menggunakan data teknis, prosedur standar, dan prinsip dasar rekayasa.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 4',
                'content' => 'Mampu menerapkan prinsip teknik mesin untuk merancang, membuat, menguji, atau merawat komponen mesin dan sistem produksi sesuai kebutuhan teknis, standar industri, serta mempertimbangkan efisiensi biaya, K3, dan pengembangan berkelanjutan.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 5',
                'content' => 'Mampu menggunakan teknologi rekayasa mekanik modern, perangkat komputasi, dan teknologi informasi untuk mendukung pekerjaan produksi atau perawatan dalam penyelesaian masalah teknik yang telah dikenal baik.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 6',
                'content' => 'Mampu berkomunikasi secara lisan, tertulis, dan grafis secara efektif dalam konteks pekerjaan teknis.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 7',
                'content' => 'Mampu mengembangkan diri secara berkelanjutan melalui pembelajaran mandiri dan kewirausahaan berbasis teknologi secara adaptif terhadap perkembangan global dan teknologi.',
                'sort_order' => 7,
                'is_active' => true,
            ],
        ]);
    }
}