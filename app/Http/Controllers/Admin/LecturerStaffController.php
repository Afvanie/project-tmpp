<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LecturerStaff;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class LecturerStaffController extends Controller
{
    /**
     * Menampilkan daftar dosen dan staf.
     */
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | PENCARIAN
        |--------------------------------------------------------------------------
        */

        $search = trim(
            (string) $request->query('search', '')
        );

        $search = mb_substr($search, 0, 100);

        /*
        |--------------------------------------------------------------------------
        | FILTER JENIS
        |--------------------------------------------------------------------------
        */

        $type = strtolower(
            trim(
                (string) $request->query('type', 'all')
            )
        );

        $allowedTypes = [
            'all',
            LecturerStaff::TYPE_DOSEN,
            LecturerStaff::TYPE_STAFF,
        ];

        if (!in_array($type, $allowedTypes, true)) {
            $type = 'all';
        }

        /*
        |--------------------------------------------------------------------------
        | QUERY
        |--------------------------------------------------------------------------
        */

        $query = LecturerStaff::query();

        if ($search !== '') {
            $query->where(
                function (Builder $query) use ($search): void {
                    $query
                        ->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'nip',
                            'like',
                            '%' . $search . '%'
                        );
                }
            );
        }

        if (
            in_array(
                $type,
                [
                    LecturerStaff::TYPE_DOSEN,
                    LecturerStaff::TYPE_STAFF,
                ],
                true
            )
        ) {
            $query->where('type', $type);
        }

        /*
        |--------------------------------------------------------------------------
        | URUTAN DAN PAGINATION
        |--------------------------------------------------------------------------
        */

        $lecturerStaff = $query
            ->orderByRaw(
                "
                CASE
                    WHEN type = 'dosen' THEN 1
                    WHEN type = 'staff' THEN 2
                    ELSE 3
                END
                "
            )
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalAll = LecturerStaff::query()->count();

        $totalDosen = LecturerStaff::query()
            ->where(
                'type',
                LecturerStaff::TYPE_DOSEN
            )
            ->count();

        $totalStaff = LecturerStaff::query()
            ->where(
                'type',
                LecturerStaff::TYPE_STAFF
            )
            ->count();

        return view('admin.lecturer-staff.index', [
            'lecturerStaff' => $lecturerStaff,
            'search' => $search,
            'type' => $type,
            'totalAll' => $totalAll,
            'totalDosen' => $totalDosen,
            'totalStaff' => $totalStaff,
        ]);
    }

    /**
     * Menampilkan formulir tambah.
     */
    public function create(): View
    {
        return view('admin.lecturer-staff.create', [
            'types' => LecturerStaff::types(),
        ]);
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request
                ->file('photo')
                ->store('lecturer-staff', 'public');
        }

        try {
            LecturerStaff::query()->create([
                'name' => trim($validated['name']),
                'nip' => $this->nullableString(
                    $validated['nip'] ?? null
                ),
                'type' => $validated['type'],
                'photo' => $photoPath,
            ]);
        } catch (Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | Hapus foto jika penyimpanan database gagal
            |--------------------------------------------------------------------------
            */

            if (
                $photoPath
                && Storage::disk('public')->exists($photoPath)
            ) {
                Storage::disk('public')->delete($photoPath);
            }

            throw $exception;
        }

        return redirect()
            ->route('admin.lecturer-staff.index')
            ->with(
                'success',
                'Data dosen/staf berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan formulir edit.
     */
    public function edit(
        LecturerStaff $lecturerStaff
    ): View {
        return view('admin.lecturer-staff.edit', [
            'lecturerStaff' => $lecturerStaff,
            'types' => LecturerStaff::types(),
        ]);
    }

    /**
     * Memperbarui data dosen atau staf.
     */
    public function update(
        Request $request,
        LecturerStaff $lecturerStaff
    ): RedirectResponse {
        $validated = $this->validateData($request);

        $oldPhotoPath = $lecturerStaff->photo;
        $newPhotoPath = null;

        /*
        |--------------------------------------------------------------------------
        | Simpan foto baru terlebih dahulu
        |--------------------------------------------------------------------------
        |
        | Foto lama belum dihapus agar tetap aman apabila proses update
        | database mengalami kegagalan.
        |
        */

        if ($request->hasFile('photo')) {
            $newPhotoPath = $request
                ->file('photo')
                ->store('lecturer-staff', 'public');
        }

        $finalPhotoPath = $newPhotoPath ?: $oldPhotoPath;

        try {
            $lecturerStaff->update([
                'name' => trim($validated['name']),
                'nip' => $this->nullableString(
                    $validated['nip'] ?? null
                ),
                'type' => $validated['type'],
                'photo' => $finalPhotoPath,
            ]);
        } catch (Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | Bersihkan foto baru jika database gagal diperbarui
            |--------------------------------------------------------------------------
            */

            if (
                $newPhotoPath
                && Storage::disk('public')->exists($newPhotoPath)
            ) {
                Storage::disk('public')->delete($newPhotoPath);
            }

            throw $exception;
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus foto lama setelah database berhasil diperbarui
        |--------------------------------------------------------------------------
        */

        if (
            $newPhotoPath
            && $oldPhotoPath
            && $oldPhotoPath !== $newPhotoPath
            && Storage::disk('public')->exists($oldPhotoPath)
        ) {
            Storage::disk('public')->delete($oldPhotoPath);
        }

        return redirect()
            ->route('admin.lecturer-staff.index')
            ->with(
                'success',
                'Data dosen/staf berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data dosen atau staf.
     */
    public function destroy(
        LecturerStaff $lecturerStaff
    ): RedirectResponse {
        $photoPath = $lecturerStaff->photo;

        /*
        |--------------------------------------------------------------------------
        | Hapus database terlebih dahulu
        |--------------------------------------------------------------------------
        |
        | Foto tidak akan hilang jika penghapusan record database gagal.
        |
        */

        $lecturerStaff->delete();

        if (
            $photoPath
            && Storage::disk('public')->exists($photoPath)
        ) {
            Storage::disk('public')->delete($photoPath);
        }

        return redirect()
            ->route('admin.lecturer-staff.index')
            ->with(
                'success',
                'Data dosen/staf berhasil dihapus.'
            );
    }

    /**
     * Validasi data dosen dan staf.
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'nip' => [
                'nullable',
                'string',
                'max:100',
            ],

            'type' => [
                'required',
                Rule::in(
                    array_keys(LecturerStaff::types())
                ),
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'name.required' =>
                'Nama dosen atau staf wajib diisi.',

            'name.max' =>
                'Nama maksimal terdiri dari 255 karakter.',

            'nip.max' =>
                'NIP maksimal terdiri dari 100 karakter.',

            'type.required' =>
                'Jenis personel wajib dipilih.',

            'type.in' =>
                'Jenis personel harus berupa dosen atau staf.',

            'photo.image' =>
                'Foto yang dipilih harus berupa gambar.',

            'photo.mimes' =>
                'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',

            'photo.max' =>
                'Ukuran foto maksimal adalah 2 MB.',
        ]);
    }

    /**
     * Mengubah string kosong menjadi null.
     */
    private function nullableString(mixed $value): ?string
    {
        $value = trim((string) $value);

        return $value !== '' ? $value : null;
    }
}