<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Contracts\View\View;

class FacilityController extends Controller
{
    /**
     * Menampilkan fasilitas aktif beserta foto aktifnya.
     */
    public function index(): View
    {
        $facilities = Facility::query()
            ->active()
            ->ordered()
            ->with([
                'photos' => function ($query): void {
                    $query
                        ->active()
                        ->ordered();
                },
            ])
            ->get();

        return view('frontend.facilities', [
            'facilities' => $facilities,
        ]);
    }
}