<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    /**
     * Menampilkan halaman kontak Program Studi D-IV TMPP.
     */
    public function index(): View
    {
        return view('frontend.contact');
    }
}