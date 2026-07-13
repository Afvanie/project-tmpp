<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use App\Models\HomeStatistic;

class HomeController extends Controller
{
    public function index()
    {
        $homeContent = HomeContent::where('section_key', 'program_description')
            ->where('is_active', true)
            ->first();

        $homeStats = HomeStatistic::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.home', compact('homeContent', 'homeStats'));
    }
}