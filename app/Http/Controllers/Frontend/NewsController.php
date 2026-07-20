<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Contracts\View\View;

class NewsController extends Controller
{
    public function show(
        News $news
    ): View {
        abort_unless(
            $news->is_active
            && $news->published_at !== null
            && $news->published_at
                ->lessThanOrEqualTo(
                    now()
                ),
            404
        );

        return view(
            'frontend.news.show',
            [
                'news' => $news,
            ]
        );
    }
}