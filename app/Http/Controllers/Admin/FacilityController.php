<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\FacilityPhoto;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class FacilityController extends Controller
{
    /**
     * Menampilkan seluruh kategori fasilitas.
     */
    public function index(): View
    {
        $facilities = Facility::query()
            ->withCount('photos')
            ->ordered()
            ->get();

        return view('admin.facilities.index', [
            'facilities' => $facilities,
        ]);
    }

    /**
     * Menampilkan halaman pengelolaan kategori dan foto fasilitas.
     */
    public function edit(Facility $facility): View
    {
        $facility->load([
            'photos' => function (Builder $query): void {
                $query->ordered();
            },
        ]);

        return view('admin.facilities.edit', [
            'facility' => $facility,
        ]);
    }

    /**
     * Memperbarui informasi kategori fasilitas.
     */
    public function update(
        Request $request,
        Facility $facility
    ): RedirectResponse {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'title.required' =>
                'Nama kategori fasilitas wajib diisi.',

            'title.max' =>
                'Nama kategori fasilitas maksimal 255 karakter.',

            'description.string' =>
                'Deskripsi fasilitas harus berupa teks.',

            'sort_order.integer' =>
                'Urutan tampil harus berupa angka.',

            'sort_order.min' =>
                'Urutan tampil tidak boleh kurang dari 0.',

            'is_active.boolean' =>
                'Status fasilitas tidak valid.',
        ]);

        $facility->update([
            'title' => trim($validated['title']),

            'description' => $this->nullableString(
                $validated['description'] ?? null
            ),

            'sort_order' => $validated['sort_order']
                ?? $facility->sort_order,

            'is_active' => $request->boolean(
                'is_active'
            ),
        ]);

        return redirect()
            ->route('admin.facilities.edit', $facility)
            ->with(
                'success',
                'Informasi fasilitas berhasil diperbarui.'
            );
    }

    /**
     * Menambahkan foto pada kategori fasilitas tertentu.
     */
    public function storePhoto(
        Request $request,
        Facility $facility
    ): RedirectResponse {
        $validated = $this->validatePhotoData(
            $request,
            true
        );

        $photoPath = $this->storePhotoFile($request);

        try {
            $facility->photos()->create([
                'title' => $this->nullableString(
                    $validated['title'] ?? null
                ),

                'photo' => $photoPath,

                'sort_order' => $validated['sort_order']
                    ?? 0,

                'is_active' => $request->boolean(
                    'is_active'
                ),
            ]);
        } catch (Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | Hapus file apabila penyimpanan database gagal
            |--------------------------------------------------------------------------
            */

            $this->deleteStoredPhoto($photoPath);

            throw $exception;
        }

        return redirect()
            ->route('admin.facilities.edit', $facility)
            ->with(
                'success',
                'Foto fasilitas berhasil ditambahkan.'
            );
    }

    /**
     * Memperbarui foto dan informasi dokumentasi fasilitas.
     */
    public function updatePhoto(
        Request $request,
        FacilityPhoto $facilityPhoto
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | Foto baru tidak wajib
        |--------------------------------------------------------------------------
        |
        | Admin tetap dapat memperbarui judul, urutan, dan status tanpa
        | harus mengunggah ulang foto.
        |
        */

        $validated = $this->validatePhotoData(
            $request,
            false
        );

        $oldPhotoPath = trim(
            (string) $facilityPhoto->photo
        );

        $newPhotoPath = null;

        /*
        |--------------------------------------------------------------------------
        | Simpan foto baru terlebih dahulu
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {
            $newPhotoPath = $this->storePhotoFile(
                $request
            );
        }

        $updateData = [
            'title' => $this->nullableString(
                $validated['title'] ?? null
            ),

            'sort_order' => $validated['sort_order']
                ?? $facilityPhoto->sort_order,

            'is_active' => $request->boolean(
                'is_active'
            ),
        ];

        if ($newPhotoPath !== null) {
            $updateData['photo'] = $newPhotoPath;
        }

        try {
            $facilityPhoto->update($updateData);
        } catch (Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | Bersihkan foto baru apabila update database gagal
            |--------------------------------------------------------------------------
            */

            if ($newPhotoPath !== null) {
                $this->deleteStoredPhoto(
                    $newPhotoPath
                );
            }

            throw $exception;
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus foto lama setelah database berhasil diperbarui
        |--------------------------------------------------------------------------
        */

        if (
            $newPhotoPath !== null
            && $oldPhotoPath !== ''
            && $oldPhotoPath !== $newPhotoPath
        ) {
            $this->deleteStoredPhoto(
                $oldPhotoPath
            );
        }

        return redirect()
            ->route(
                'admin.facilities.edit',
                $facilityPhoto->facility
            )
            ->with(
                'success',
                'Foto fasilitas berhasil diperbarui.'
            );
    }

    /**
     * Menghapus foto dokumentasi fasilitas.
     */
    public function destroyPhoto(
        FacilityPhoto $facilityPhoto
    ): RedirectResponse {
        $facility = $facilityPhoto->facility;

        $photoPath = trim(
            (string) $facilityPhoto->photo
        );

        /*
        |--------------------------------------------------------------------------
        | Hapus record database terlebih dahulu
        |--------------------------------------------------------------------------
        |
        | File tidak ikut hilang apabila penghapusan database gagal.
        |
        */

        $facilityPhoto->delete();

        $this->deleteStoredPhoto($photoPath);

        return redirect()
            ->route('admin.facilities.edit', $facility)
            ->with(
                'success',
                'Foto fasilitas berhasil dihapus.'
            );
    }

    /**
     * Menambahkan foto melalui halaman utama fasilitas admin.
     */
    public function storePhotoGeneral(
        Request $request
    ): RedirectResponse {
        $validated = $request->validate([
            'facility_id' => [
                'required',
                'integer',
                'exists:facilities,id',
            ],

            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'photo' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], $this->photoValidationMessages());

        $facility = Facility::query()->findOrFail(
            $validated['facility_id']
        );

        $photoPath = $this->storePhotoFile($request);

        try {
            $facility->photos()->create([
                'title' => $this->nullableString(
                    $validated['title'] ?? null
                ),

                'photo' => $photoPath,

                'sort_order' => $validated['sort_order']
                    ?? 0,

                'is_active' => $request->boolean(
                    'is_active'
                ),
            ]);
        } catch (Throwable $exception) {
            $this->deleteStoredPhoto($photoPath);

            throw $exception;
        }

        return redirect()
            ->route('admin.facilities.index')
            ->with(
                'success',
                'Foto dokumentasi berhasil ditambahkan.'
            );
    }

    /**
     * Validasi formulir dokumentasi foto.
     */
    private function validatePhotoData(
        Request $request,
        bool $photoRequired
    ): array {
        return $request->validate([
            'title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'photo' => [
                $photoRequired
                    ? 'required'
                    : 'nullable',

                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], $this->photoValidationMessages());
    }

    /**
     * Pesan validasi dokumentasi foto.
     */
    private function photoValidationMessages(): array
    {
        return [
            'facility_id.required' =>
                'Kategori fasilitas wajib dipilih.',

            'facility_id.integer' =>
                'Kategori fasilitas tidak valid.',

            'facility_id.exists' =>
                'Kategori fasilitas yang dipilih tidak ditemukan.',

            'title.max' =>
                'Judul foto maksimal 255 karakter.',

            'photo.required' =>
                'Foto dokumentasi wajib dipilih.',

            'photo.image' =>
                'File yang dipilih harus berupa gambar.',

            'photo.mimes' =>
                'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',

            'photo.max' =>
                'Ukuran foto maksimal adalah 20 MB.',

            'sort_order.integer' =>
                'Urutan tampil harus berupa angka.',

            'sort_order.min' =>
                'Urutan tampil tidak boleh kurang dari 0.',

            'is_active.boolean' =>
                'Status foto tidak valid.',
        ];
    }

    /**
     * Menyimpan foto ke disk public.
     */
    private function storePhotoFile(
        Request $request
    ): string {
        $file = $request->file('photo');

        if ($file === null) {
            throw new RuntimeException(
                'File foto tidak ditemukan.'
            );
        }

        $photoPath = $file->store(
            'facilities',
            'public'
        );

        if (
            !is_string($photoPath)
            || trim($photoPath) === ''
        ) {
            throw new RuntimeException(
                'Foto gagal disimpan ke penyimpanan.'
            );
        }

        return $photoPath;
    }

    /**
     * Menghapus foto dari disk public.
     */
    private function deleteStoredPhoto(
        ?string $photoPath
    ): void {
        $photoPath = trim(
            (string) $photoPath
        );

        if ($photoPath === '') {
            return;
        }

        $disk = Storage::disk('public');

        if ($disk->exists($photoPath)) {
            $disk->delete($photoPath);
        }
    }

    /**
     * Mengubah teks kosong menjadi null.
     */
    private function nullableString(
        mixed $value
    ): ?string {
        $value = trim(
            (string) $value
        );

        return $value !== ''
            ? $value
            : null;
    }
}