<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Accreditation;
use App\Models\HomeContent;
use App\Models\HomeStatistic;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda.
     */
    public function index(): View
    {
        /*
        |--------------------------------------------------------------------------
        | DESKRIPSI PROGRAM STUDI
        |--------------------------------------------------------------------------
        */

        $homeContent = HomeContent::query()
            ->where(
                'section_key',
                'program_description'
            )
            ->where(
                'is_active',
                true
            )
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK BERANDA
        |--------------------------------------------------------------------------
        */

        $homeStats = HomeStatistic::query()
            ->where(
                'is_active',
                true
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | AKREDITASI YANG DIPUBLIKASIKAN
        |--------------------------------------------------------------------------
        |
        | Hanya data yang diaktifkan melalui panel admin yang disiapkan
        | untuk halaman publik. Nomor sertifikat dan masa berlaku tetap
        | boleh kosong ketika dokumen resmi belum tersedia.
        |
        */

        $accreditations = Accreditation::query()
            ->active()
            ->ordered()
            ->get();

        return view('frontend.home', [
            'homeContent' => $homeContent,
            'homeStats' => $homeStats,
            'accreditations' => $accreditations,
        ]);
    }
}