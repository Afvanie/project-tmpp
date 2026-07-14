<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Memastikan pengguna memiliki sesi admin yang valid.
     */
    public function handle(
        Request $request,
        Closure $next
    ): Response {
        $adminId = (int) $request
            ->session()
            ->get('admin_id', 0);

        /*
        |--------------------------------------------------------------------------
        | SESI ADMIN TIDAK TERSEDIA
        |--------------------------------------------------------------------------
        */

        if ($adminId <= 0) {
            return redirect()
                ->route('admin.login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu untuk mengakses halaman admin.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | PERIKSA AKUN ADMIN
        |--------------------------------------------------------------------------
        |
        | Pemeriksaan ini mencegah session lama tetap digunakan apabila akun
        | admin telah dihapus dari database.
        |
        */

        $admin = Admin::query()
            ->select([
                'id',
                'name',
                'email',
            ])
            ->find($adminId);

        if ($admin === null) {
            $this->invalidateAdminSession($request);

            return redirect()
                ->route('admin.login')
                ->with(
                    'error',
                    'Sesi admin sudah tidak valid. Silakan login kembali.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | SINKRONKAN DATA SESSION
        |--------------------------------------------------------------------------
        |
        | Nama dan email pada session diperbarui agar selalu sesuai dengan
        | data akun terbaru.
        |
        */

        $request->session()->put([
            'admin_id' => $admin->id,
            'admin_name' => $admin->name,
            'admin_email' => $admin->email,
        ]);

        /*
        |--------------------------------------------------------------------------
        | BAGIKAN ADMIN AKTIF KE REQUEST
        |--------------------------------------------------------------------------
        |
        | Controller atau middleware lain dapat mengambilnya melalui:
        |
        | $request->attributes->get('current_admin')
        |
        */

        $request->attributes->set(
            'current_admin',
            $admin
        );

        return $next($request);
    }

    /**
     * Menghapus dan mengakhiri sesi admin yang tidak valid.
     */
    private function invalidateAdminSession(
        Request $request
    ): void {
        $request->session()->forget([
            'admin_id',
            'admin_name',
            'admin_email',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}