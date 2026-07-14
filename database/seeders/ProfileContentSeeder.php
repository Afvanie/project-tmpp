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
        | VISI DAN MISI
        |--------------------------------------------------------------------------
        */

        $visiMisi = ProfileSection::updateOrCreate(
            ['slug' => 'visi-misi'],
            [
                'title' => 'Visi dan Misi',
                'subtitle' => 'Arah Pengembangan Program Studi',
                'description' => 'Visi keilmuan dan misi Program Studi D-IV Teknik Mesin Produksi dan Perawatan Politeknik Negeri Malang.',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | TUJUAN PROGRAM STUDI
        |--------------------------------------------------------------------------
        |
        | Materi tujuan resmi TMPP belum tersedia pada dokumen.
        | Section tetap tersedia dan isi yang ditambahkan pengelola melalui
        | halaman admin tidak akan dihapus ketika seeder dijalankan kembali.
        |
        */

        /*
        |--------------------------------------------------------------------------
        | MASUKKAN MATERI D-IV TMPP
        |--------------------------------------------------------------------------
        */

        $visiMisi->items()->createMany([
            [
                'item_group' => 'visi',
                'title' => 'Visi Keilmuan',
                'content' => 'Menjadi Program Studi Teknik Mesin Produksi dan Perawatan yang Unggul dalam Autonomous Maintenance pada Persaingan Global Tahun 2030.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 1',
                'content' => 'Melaksanakan dan mengembangkan pendidikan dan pengajaran bidang Teknik Mesin Produksi dan Perawatan yang berkualitas dan inovatif untuk menghasilkan lulusan dengan kompetensi bidang teknologi teknik mesin.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 2',
                'content' => 'Melakukan penelitian dan pengabdian kepada masyarakat dalam bidang Teknik Mesin Produksi dan Perawatan yang bermanfaat bagi pengembangan ilmu pengetahuan dan teknologi serta kesejahteraan masyarakat.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 3',
                'content' => 'Menciptakan suasana akademik yang kondusif untuk meningkatkan mutu sumber daya manusia dan proses pembelajaran serta tumbuhnya jiwa technopreneur.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'item_group' => 'misi',
                'title' => 'Misi 4',
                'content' => 'Menjalin kerja sama yang saling menguntungkan dengan berbagai pihak dalam pengembangan pendidikan, penelitian, dan pengabdian kepada masyarakat bidang Teknik Mesin Produksi dan Perawatan.',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | TUJUAN PROGRAM STUDI
        |--------------------------------------------------------------------------
        |
        | Materi resmi Tujuan Program Studi D-IV TMPP belum tersedia
        | pada dokumen yang diberikan.
        |
        | Section tetap dipertahankan agar nantinya dapat diisi oleh
        | pengelola melalui halaman admin.
        |
        */

        $tujuan = ProfileSection::updateOrCreate(
            ['slug' => 'tujuan-prodi'],
            [
                'title' => 'Tujuan Program Studi',
                'subtitle' => 'Sasaran Penyelenggaraan Pendidikan',
                'description' => null,
                'sort_order' => 2,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | KOSONGKAN TUJUAN LAMA MILIK D-III
        |--------------------------------------------------------------------------
        */

        $tujuan->items()->delete();

        /*
        |--------------------------------------------------------------------------
        | PROFIL PROFESIONAL MANDIRI
        |--------------------------------------------------------------------------
        */

        $ppm = ProfileSection::updateOrCreate(
            ['slug' => 'ppm'],
            [
                'title' => 'Profil Profesional Mandiri',
                'subtitle' => 'Karakter Profesional Lulusan',
                'description' => 'Profil Profesional Mandiri lulusan Program Studi D-IV Teknik Mesin Produksi dan Perawatan.',
                'sort_order' => 3,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | HAPUS MATERI PPM LAMA D-III
        |--------------------------------------------------------------------------
        */

        $ppm->items()->delete();

        /*
        |--------------------------------------------------------------------------
        | MASUKKAN PPM D-IV TMPP
        |--------------------------------------------------------------------------
        */

        $ppm->items()->createMany([
            [
                'item_group' => 'ppm',
                'title' => 'PPM-1',
                'content' => 'Profesional yang menjunjung tinggi nilai kemanusiaan berdasarkan agama, moral, dan Pancasila.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'ppm',
                'title' => 'PPM-2',
                'content' => 'Profesional yang memiliki kontribusi secara aktif dan inovatif dalam kancah nasional dan internasional sebagai sarjana terapan yang profesional, baik secara individu maupun teamwork, serta berkarakter autonomous maintenance sesuai dengan standar di bidang teknik mesin produksi dan perawatan.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'ppm',
                'title' => 'PPM-3',
                'content' => 'Profesional yang memiliki kemampuan berpikir kreatif, adaptif, dan continuous improvement sesuai dengan karakter autonomous maintenance pada bidang teknik mesin produksi dan perawatan.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | CAPAIAN PEMBELAJARAN LULUSAN
        |--------------------------------------------------------------------------
        */

        $cpl = ProfileSection::updateOrCreate(
            ['slug' => 'cpl'],
            [
                'title' => 'Capaian Pembelajaran Lulusan',
                'subtitle' => 'Kompetensi Sarjana Terapan TMPP',
                'description' => 'Capaian Pembelajaran Lulusan Program Studi D-IV Teknik Mesin Produksi dan Perawatan jenjang Sarjana Terapan dan KKNI Level 6.',
                'sort_order' => 4,
                'is_active' => true,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | HAPUS CPL LAMA D-III
        |--------------------------------------------------------------------------
        */

        $cpl->items()->delete();

        /*
        |--------------------------------------------------------------------------
        | MASUKKAN 9 CPL D-IV TMPP
        |--------------------------------------------------------------------------
        */

        $cpl->items()->createMany([
            [
                'item_group' => 'cpl',
                'title' => 'CPL 1',
                'content' => 'Mampu menerapkan matematika terapan, ilmu alam, komputasi, dasar rekayasa, dan ilmu keteknikan mesin untuk memahami, menganalisis, dan menyelesaikan permasalahan teknik mesin produksi dan perawatan.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 2',
                'content' => 'Mampu mengidentifikasi, merumuskan, menganalisis, dan mengevaluasi permasalahan pada proses produksi, sistem manufaktur, komponen mesin, kualitas produk, dan sistem perawatan berdasarkan data, standar, literatur, serta metode analisis teknik yang sesuai.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 3',
                'content' => 'Mampu merancang, mengembangkan, dan mengevaluasi komponen, jig and fixture, proses manufaktur, sistem produksi, serta prosedur perawatan dengan mempertimbangkan fungsi, standar teknik, keselamatan, biaya, efisiensi sumber daya, dan keberlanjutan.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 4',
                'content' => 'Mampu menggunakan mesin produksi, alat ukur, peralatan bengkel atau laboratorium, CAD/CAM/CAE, CNC, sensor, aktuator, PLC, sistem otomasi, dan teknologi informasi untuk mendukung proses desain, manufaktur, inspeksi, troubleshooting, dan perawatan mesin.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 5',
                'content' => 'Mampu mengoperasikan, mengendalikan, merawat, mengevaluasi, dan meningkatkan proses pemesinan, fabrikasi, pengelasan, pembentukan, perakitan, sistem manufaktur, serta sistem perawatan mesin sesuai prosedur kerja, standar mutu, dan K3L.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 6',
                'content' => 'Mampu menerapkan autonomous maintenance atau perawatan mandiri atau jishu hozen, troubleshooting, preventive maintenance, corrective maintenance, quality control, lean manufacturing, dan continuous improvement untuk meningkatkan keandalan mesin, produktivitas, mutu, dan efisiensi proses produksi.',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 7',
                'content' => 'Mampu menunjukkan etika, integritas, tanggung jawab profesional, kepatuhan terhadap norma, hukum, standar industri, budaya K3L, keberagaman, inklusivitas, serta kesadaran terhadap dampak sosial, ekonomi, dan lingkungan dalam praktik rekayasa.',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 8',
                'content' => 'Mampu bekerja secara efektif sebagai individu, anggota, maupun pemimpin tim multidisiplin serta berkomunikasi secara lisan, tertulis, grafis, dan digital dalam laporan teknis, gambar kerja, instruksi kerja, dokumentasi perawatan, presentasi, dan kegiatan rekayasa.',
                'sort_order' => 8,
                'is_active' => true,
            ],
            [
                'item_group' => 'cpl',
                'title' => 'CPL 9',
                'content' => 'Mampu menerapkan manajemen rekayasa, manajemen proyek, manajemen risiko, kewirausahaan, pembelajaran mandiri, pembelajaran sepanjang hayat, dan berpikir kritis untuk mengembangkan solusi, produk, jasa, atau sistem rekayasa terapan di bidang produksi dan perawatan.',
                'sort_order' => 9,
                'is_active' => true,
            ],
        ]);
    }
}