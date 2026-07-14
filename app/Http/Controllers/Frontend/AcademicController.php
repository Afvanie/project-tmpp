<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademicDocument;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class AcademicController extends Controller
{
    /**
     * Daftar halaman akademik yang tersedia.
     *
     * Slug digunakan pada URL, sedangkan category digunakan
     * untuk mengambil dokumen dari database.
     */
    private const PAGES = [
        'pedoman-akademik' => [
            'category' => 'pedoman_akademik',
            'title' => 'Pedoman Akademik',
            'subtitle' => 'Dokumen pedoman akademik Program Studi D-IV Teknik Mesin Produksi dan Perawatan.',
        ],

        'kalender-akademik' => [
            'category' => 'kalender_akademik',
            'title' => 'Kalender Akademik',
            'subtitle' => 'Informasi kalender kegiatan akademik Program Studi D-IV Teknik Mesin Produksi dan Perawatan.',
        ],

        'kurikulum' => [
            'category' => 'kurikulum',
            'title' => 'Kurikulum',
            'subtitle' => 'Struktur kurikulum dan informasi mata kuliah Program Studi D-IV Teknik Mesin Produksi dan Perawatan.',
        ],

        'jadwal-kuliah' => [
            'category' => 'jadwal_kuliah',
            'title' => 'Jadwal Kuliah',
            'subtitle' => 'Informasi jadwal perkuliahan Program Studi D-IV Teknik Mesin Produksi dan Perawatan.',
        ],

        'laporan-ketercapaian' => [
            'category' => 'laporan_ketercapaian',
            'title' => 'Laporan Ketercapaian',
            'subtitle' => 'Dokumen laporan ketercapaian pembelajaran Program Studi D-IV Teknik Mesin Produksi dan Perawatan.',
        ],

        'panduan-laporan-tugas-akhir' => [
            'category' => 'panduan_laporan_tugas_akhir',
            'title' => 'Panduan Laporan Tugas Akhir',
            'subtitle' => 'Dokumen panduan penyusunan laporan tugas akhir mahasiswa Program Studi D-IV Teknik Mesin Produksi dan Perawatan.',
        ],

        /*
        |--------------------------------------------------------------------------
        | Panduan Magang Industri
        |--------------------------------------------------------------------------
        |
        | Slug dan category lama tetap dipertahankan agar kompatibel
        | dengan route, menu, database, dan dokumen yang sudah ada.
        |
        */

        'panduan-laporan-pkl' => [
            'category' => 'panduan_laporan_pkl',
            'title' => 'Panduan Magang Industri',
            'subtitle' => 'Dokumen panduan pelaksanaan Magang Industri mahasiswa Program Studi D-IV Teknik Mesin Produksi dan Perawatan.',
        ],
    ];

    /**
     * Mengarahkan halaman akademik utama ke Pedoman Akademik.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route(
            'academic.page',
            'pedoman-akademik'
        );
    }

    /**
     * Menampilkan halaman dokumen berdasarkan slug akademik.
     */
    public function page(string $slug): View
    {
        abort_unless(
            array_key_exists($slug, self::PAGES),
            404
        );

        $page = self::PAGES[$slug];

        $documents = AcademicDocument::query()
            ->where('is_active', true)
            ->where('category', $page['category'])
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('frontend.academic', [
            'page' => $page,
            'slug' => $slug,
            'pages' => self::PAGES,
            'documents' => $documents,
        ]);
    }
}