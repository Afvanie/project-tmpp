<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Menampilkan seluruh akun pengelola admin.
     */
    public function index(): View
    {
        $admins = Admin::query()
            ->select([
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ])
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return view('admin.admin-users.index', [
            'admins' => $admins,
        ]);
    }

    /**
     * Menampilkan formulir tambah admin.
     */
    public function create(): View
    {
        return view('admin.admin-users.create');
    }

    /**
     * Menyimpan akun admin baru.
     */
    public function store(
        Request $request
    ): RedirectResponse {
        $this->normalizeInput($request);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('admins', 'email'),
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
                'confirmed',
            ],
        ], $this->validationMessages());

        /*
        |--------------------------------------------------------------------------
        | KATA SANDI
        |--------------------------------------------------------------------------
        |
        | Tidak perlu menggunakan Hash::make() karena model Admin telah
        | memakai cast "hashed".
        |
        */

        Admin::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return redirect()
            ->route('admin.admin-users.index')
            ->with(
                'success',
                'Admin pengelola berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan formulir edit admin.
     */
    public function edit(
        Admin $adminUser
    ): View {
        return view('admin.admin-users.edit', [
            'adminUser' => $adminUser,
        ]);
    }

    /**
     * Memperbarui akun admin.
     */
    public function update(
        Request $request,
        Admin $adminUser
    ): RedirectResponse {
        $this->normalizeInput($request);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',

                Rule::unique('admins', 'email')
                    ->ignore($adminUser->getKey()),
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:255',
                'confirmed',
            ],
        ], $this->validationMessages());

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        /*
        |--------------------------------------------------------------------------
        | PASSWORD OPSIONAL
        |--------------------------------------------------------------------------
        |
        | Kata sandi lama tetap dipertahankan apabila kolom kata sandi
        | pada formulir edit dikosongkan.
        |
        */

        if (
            isset($validated['password'])
            && $validated['password'] !== ''
        ) {
            $updateData['password'] =
                $validated['password'];
        }

        $adminUser->update($updateData);

        /*
        |--------------------------------------------------------------------------
        | PERBARUI SESSION ADMIN YANG SEDANG LOGIN
        |--------------------------------------------------------------------------
        |
        | Login pada proyek ini menggunakan session admin_id, bukan guard
        | auth('admin'). Oleh karena itu, nama dan email pada session juga
        | harus diperbarui ketika admin mengedit akunnya sendiri.
        |
        */

        $currentAdminId = (int) $request
            ->session()
            ->get('admin_id', 0);

        if (
            $currentAdminId ===
            (int) $adminUser->getKey()
        ) {
            $request->session()->put([
                'admin_name' => $adminUser->name,
                'admin_email' => $adminUser->email,
            ]);
        }

        return redirect()
            ->route('admin.admin-users.index')
            ->with(
                'success',
                'Data admin pengelola berhasil diperbarui.'
            );
    }

    /**
     * Menghapus akun admin.
     */
    public function destroy(
        Request $request,
        Admin $adminUser
    ): RedirectResponse {
        $currentAdminId = (int) $request
            ->session()
            ->get('admin_id', 0);

        /*
        |--------------------------------------------------------------------------
        | LARANG HAPUS AKUN SENDIRI
        |--------------------------------------------------------------------------
        */

        if (
            $currentAdminId ===
            (int) $adminUser->getKey()
        ) {
            return redirect()
                ->route('admin.admin-users.index')
                ->with(
                    'error',
                    'Akun admin yang sedang digunakan tidak dapat dihapus.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | PASTIKAN MINIMAL SATU ADMIN
        |--------------------------------------------------------------------------
        |
        | Baris akun admin dikunci selama pemeriksaan dan penghapusan agar
        | dua permintaan bersamaan tidak menghapus seluruh akun admin.
        |
        */

        $deleted = DB::transaction(
            function () use ($adminUser): bool {
                $adminIds = Admin::query()
                    ->lockForUpdate()
                    ->pluck('id');

                if ($adminIds->count() <= 1) {
                    return false;
                }

                $adminToDelete = Admin::query()
                    ->whereKey($adminUser->getKey())
                    ->lockForUpdate()
                    ->first();

                if ($adminToDelete === null) {
                    return false;
                }

                return (bool) $adminToDelete->delete();
            }
        );

        if (!$deleted) {
            return redirect()
                ->route('admin.admin-users.index')
                ->with(
                    'error',
                    'Minimal harus tersedia satu akun admin.'
                );
        }

        return redirect()
            ->route('admin.admin-users.index')
            ->with(
                'success',
                'Admin pengelola berhasil dihapus.'
            );
    }

    /**
     * Menormalisasi data sebelum validasi.
     */
    private function normalizeInput(
        Request $request
    ): void {
        $request->merge([
            'name' => trim(
                (string) $request->input('name')
            ),

            'email' => Str::lower(
                trim(
                    (string) $request->input('email')
                )
            ),
        ]);
    }

    /**
     * Pesan validasi akun admin.
     *
     * @return array<string, string>
     */
    private function validationMessages(): array
    {
        return [
            'name.required' =>
                'Nama admin wajib diisi.',

            'name.string' =>
                'Nama admin harus berupa teks.',

            'name.max' =>
                'Nama admin maksimal 255 karakter.',

            'email.required' =>
                'Email admin wajib diisi.',

            'email.email' =>
                'Format email admin tidak valid.',

            'email.max' =>
                'Email admin maksimal 255 karakter.',

            'email.unique' =>
                'Email tersebut sudah digunakan oleh admin lain.',

            'password.required' =>
                'Kata sandi wajib diisi.',

            'password.min' =>
                'Kata sandi minimal terdiri dari 8 karakter.',

            'password.max' =>
                'Kata sandi maksimal terdiri dari 255 karakter.',

            'password.confirmed' =>
                'Konfirmasi kata sandi tidak sesuai.',
        ];
    }
}