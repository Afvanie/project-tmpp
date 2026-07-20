<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Accreditation;
use App\Models\HomeContent;
use App\Models\HomeStatistic;
use App\Models\News;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
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

        $homeStats = HomeStatistic::query()
            ->where(
                'is_active',
                true
            )
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $accreditations = Accreditation::query()
            ->active()
            ->ordered()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | BERITA TERBARU
        |--------------------------------------------------------------------------
        */

        $latestNews = News::query()
            ->published()
            ->latestPublished()
            ->limit(3)
            ->get();

        return view(
            'frontend.home',
            [
                'homeContent' =>
                    $homeContent,

                'homeStats' =>
                    $homeStats,

                'accreditations' =>
                    $accreditations,

                'latestNews' =>
                    $latestNews,
            ]
        );
    }
}