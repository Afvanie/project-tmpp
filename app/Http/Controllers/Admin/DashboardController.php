<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicDocument;
use App\Models\Admin;
use App\Models\FacilityPhoto;
use App\Models\LecturerStaff;
use App\Models\ProfileSection;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard pengelolaan website.
     */
    public function index(): View
    {
        $stats = [
            'lecturers' => LecturerStaff::query()
                ->where(
                    'type',
                    LecturerStaff::TYPE_DOSEN
                )
                ->count(),

            'staff' => LecturerStaff::query()
                ->where(
                    'type',
                    LecturerStaff::TYPE_STAFF
                )
                ->count(),

            'academic_documents' => AcademicDocument::query()
                ->count(),

            'facility_photos' => FacilityPhoto::query()
                ->count(),

            'admins' => Admin::query()
                ->count(),

            'profile_sections' => ProfileSection::query()
                ->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | DOKUMEN AKADEMIK TERBARU
        |--------------------------------------------------------------------------
        |
        | Menampilkan seluruh status dokumen karena halaman ini digunakan
        | oleh admin, termasuk dokumen yang belum dipublikasikan.
        |
        */

        $latestDocuments = AcademicDocument::query()
            ->select([
                'id',
                'title',
                'category',
                'academic_year',
                'is_active',
                'created_at',
            ])
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | FOTO FASILITAS TERBARU
        |--------------------------------------------------------------------------
        |
        | Relasi fasilitas dimuat sekaligus agar tidak terjadi N+1 query.
        | Seluruh status foto tetap ditampilkan untuk kebutuhan admin.
        |
        */

        $latestPhotos = FacilityPhoto::query()
            ->select([
                'id',
                'facility_id',
                'title',
                'photo',
                'is_active',
                'created_at',
            ])
            ->with([
                'facility:id,title',
            ])
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('admin.index', [
            'stats' => $stats,
            'latestDocuments' => $latestDocuments,
            'latestPhotos' => $latestPhotos,
        ]);
    }
}