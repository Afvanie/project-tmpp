<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login admin.
     */
    public function showLogin(
        Request $request
    ): View|RedirectResponse {
        $adminId = $request->session()->get(
            'admin_id'
        );

        /*
        |--------------------------------------------------------------------------
        | ADMIN SUDAH LOGIN
        |--------------------------------------------------------------------------
        */

        if (
            $adminId !== null
            && Admin::query()
                ->whereKey($adminId)
                ->exists()
        ) {
            return redirect()->route(
                'admin.dashboard'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | BERSIHKAN SESI ADMIN YANG SUDAH TIDAK VALID
        |--------------------------------------------------------------------------
        |
        | Contohnya ketika akun admin telah dihapus tetapi browser masih
        | menyimpan admin_id dari sesi sebelumnya.
        |
        */

        if ($adminId !== null) {
            $this->forgetAdminSession($request);
        }

        return view('admin.auth.login');
    }

    /**
     * Memproses autentikasi admin.
     */
    public function login(
        Request $request
    ): RedirectResponse {
        $validated = $request->validate([
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
                'max:255',
            ],
        ], [
            'email.required' =>
                'Email admin wajib diisi.',

            'email.string' =>
                'Email admin tidak valid.',

            'email.email' =>
                'Format email admin tidak valid.',

            'email.max' =>
                'Email admin maksimal 255 karakter.',

            'password.required' =>
                'Kata sandi wajib diisi.',

            'password.string' =>
                'Kata sandi tidak valid.',

            'password.max' =>
                'Kata sandi maksimal 255 karakter.',
        ]);

        $email = Str::lower(
            trim($validated['email'])
        );

        $throttleKey = $this->throttleKey(
            $email,
            $request
        );

        /*
        |--------------------------------------------------------------------------
        | BATASI PERCOBAAN LOGIN
        |--------------------------------------------------------------------------
        |
        | Maksimal lima percobaan gagal dalam satu menit untuk kombinasi
        | email dan alamat IP yang sama.
        |
        */

        if (
            RateLimiter::tooManyAttempts(
                $throttleKey,
                5
            )
        ) {
            $availableIn = RateLimiter::availableIn(
                $throttleKey
            );

            return back()
                ->withErrors([
                    'email' =>
                        'Terlalu banyak percobaan login. '
                        . 'Silakan coba kembali dalam '
                        . $availableIn
                        . ' detik.',
                ])
                ->onlyInput('email');
        }

        $admin = Admin::query()
            ->where('email', $email)
            ->first();

        $credentialsValid = $admin !== null
            && Hash::check(
                $validated['password'],
                $admin->password
            );

        /*
        |--------------------------------------------------------------------------
        | LOGIN GAGAL
        |--------------------------------------------------------------------------
        |
        | Pesan dibuat umum agar tidak mengungkap apakah suatu email
        | terdaftar sebagai akun admin.
        |
        */

        if (!$credentialsValid) {
            RateLimiter::hit(
                $throttleKey,
                60
            );

            return back()
                ->withErrors([
                    'email' =>
                        'Email atau kata sandi admin salah.',
                ])
                ->onlyInput('email');
        }

        RateLimiter::clear($throttleKey);

        /*
        |--------------------------------------------------------------------------
        | PERBARUI HASH JIKA DIPERLUKAN
        |--------------------------------------------------------------------------
        */

        if (
            Hash::needsRehash(
                $admin->password
            )
        ) {
            $admin->password = Hash::make(
                $validated['password']
            );

            $admin->save();
        }

        /*
        |--------------------------------------------------------------------------
        | BUAT SESI ADMIN BARU
        |--------------------------------------------------------------------------
        */

        $request->session()->regenerate();

        $request->session()->put([
            'admin_id' => $admin->id,
            'admin_name' => $admin->name,
            'admin_email' => $admin->email,
        ]);

        return redirect()->intended(
            route('admin.dashboard')
        );
    }

    /**
     * Mengakhiri sesi admin.
     */
    public function logout(
        Request $request
    ): RedirectResponse {
        $this->forgetAdminSession($request);

        /*
        |--------------------------------------------------------------------------
        | INVALIDASI SELURUH SESI
        |--------------------------------------------------------------------------
        |
        | Mencegah penggunaan kembali session ID setelah admin keluar.
        |
        */

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('admin.login')
            ->with(
                'success',
                'Anda telah keluar dari halaman admin.'
            );
    }

    /**
     * Membuat kunci pembatas percobaan login.
     */
    private function throttleKey(
        string $email,
        Request $request
    ): string {
        return Str::transliterate(
            Str::lower($email)
            . '|'
            . $request->ip()
        );
    }

    /**
     * Menghapus seluruh data autentikasi admin dari sesi.
     */
    private function forgetAdminSession(
        Request $request
    ): void {
        $request->session()->forget([
            'admin_id',
            'admin_name',
            'admin_email',
        ]);
    }
}