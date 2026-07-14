<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Accreditation;
use App\Models\ProfileSection;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil Program Studi D-IV TMPP.
     */
    public function index(): View
    {
        $profileSections = ProfileSection::query()
            ->with([
                'items' => function ($query): void {
                    $query
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('id');
                },
            ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->keyBy('slug');

        /*
        |--------------------------------------------------------------------------
        | AKREDITASI PUBLIK
        |--------------------------------------------------------------------------
        |
        | Hanya data yang diaktifkan melalui panel admin.
        |
        */

        $accreditations = Accreditation::query()
            ->active()
            ->ordered()
            ->get();

        return view('frontend.profile', [
            'profileSections' => $profileSections,
            'accreditations' => $accreditations,
        ]);
    }
}