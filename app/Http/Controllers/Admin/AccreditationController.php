<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accreditation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class AccreditationController extends Controller
{
    /**
     * Menampilkan seluruh data akreditasi.
     */
    public function index(): View
    {
        $accreditations = Accreditation::query()
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        return view('admin.accreditations.index', [
            'accreditations' => $accreditations,
        ]);
    }

    /**
     * Menampilkan formulir tambah akreditasi.
     */
    public function create(): View
    {
        return view('admin.accreditations.create', [
            'types' => Accreditation::types(),
        ]);
    }

    /**
     * Menyimpan data akreditasi baru.
     */
    public function store(
        Request $request
    ): RedirectResponse {
        $this->normalizeInput($request);

        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        $storedFilePath = null;

        try {
            if ($request->hasFile('file_path')) {
                $storedFilePath = $request
                    ->file('file_path')
                    ->store(
                        'accreditations',
                        'public'
                    );
            }

            DB::transaction(
                function () use (
                    $validated,
                    $storedFilePath
                ): void {
                    Accreditation::query()->create([
                        'title' => $validated['title'],
                        'type' => $validated['type'],

                        'institution' =>
                            $validated['institution']
                            ?? null,

                        'rank' =>
                            $validated['rank']
                            ?? null,

                        'certificate_number' =>
                            $validated['certificate_number']
                            ?? null,

                        'valid_from' =>
                            $validated['valid_from']
                            ?? null,

                        'valid_until' =>
                            $validated['valid_until']
                            ?? null,

                        'file_path' => $storedFilePath,

                        'description' =>
                            $validated['description']
                            ?? null,

                        'is_active' =>
                            (bool) (
                                $validated['is_active']
                                ?? false
                            ),

                        'sort_order' =>
                            $validated['sort_order']
                            ?? 0,
                    ]);
                }
            );
        } catch (Throwable $exception) {
            if (
                $storedFilePath !== null
                && Storage::disk('public')
                    ->exists($storedFilePath)
            ) {
                Storage::disk('public')
                    ->delete($storedFilePath);
            }

            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Data akreditasi belum dapat disimpan. Silakan coba kembali.'
                );
        }

        return redirect()
            ->route('admin.accreditations.index')
            ->with(
                'success',
                'Data akreditasi berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan formulir edit akreditasi.
     */
    public function edit(
        Accreditation $accreditation
    ): View {
        return view('admin.accreditations.edit', [
            'accreditation' => $accreditation,
            'types' => Accreditation::types(),
        ]);
    }

    /**
     * Memperbarui data akreditasi.
     */
    public function update(
        Request $request,
        Accreditation $accreditation
    ): RedirectResponse {
        $this->normalizeInput($request);

        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        $oldFilePath = $accreditation->file_path;
        $newFilePath = null;

        try {
            /*
            |--------------------------------------------------------------------------
            | SIMPAN FILE BARU TERLEBIH DAHULU
            |--------------------------------------------------------------------------
            |
            | File lama belum dihapus sampai pembaruan database berhasil.
            |
            */

            if ($request->hasFile('file_path')) {
                $newFilePath = $request
                    ->file('file_path')
                    ->store(
                        'accreditations',
                        'public'
                    );
            }

            DB::transaction(
                function () use (
                    $accreditation,
                    $validated,
                    $newFilePath,
                    $oldFilePath
                ): void {
                    $accreditation->update([
                        'title' => $validated['title'],
                        'type' => $validated['type'],

                        'institution' =>
                            $validated['institution']
                            ?? null,

                        'rank' =>
                            $validated['rank']
                            ?? null,

                        'certificate_number' =>
                            $validated['certificate_number']
                            ?? null,

                        'valid_from' =>
                            $validated['valid_from']
                            ?? null,

                        'valid_until' =>
                            $validated['valid_until']
                            ?? null,

                        'file_path' =>
                            $newFilePath
                            ?? $oldFilePath,

                        'description' =>
                            $validated['description']
                            ?? null,

                        'is_active' =>
                            (bool) (
                                $validated['is_active']
                                ?? false
                            ),

                        'sort_order' =>
                            $validated['sort_order']
                            ?? 0,
                    ]);
                }
            );
        } catch (Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | BERSIHKAN FILE BARU JIKA DATABASE GAGAL DIPERBARUI
            |--------------------------------------------------------------------------
            */

            if (
                $newFilePath !== null
                && Storage::disk('public')
                    ->exists($newFilePath)
            ) {
                Storage::disk('public')
                    ->delete($newFilePath);
            }

            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Data akreditasi belum dapat diperbarui. Silakan coba kembali.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | HAPUS FILE LAMA SETELAH DATABASE BERHASIL DIPERBARUI
        |--------------------------------------------------------------------------
        */

        if (
            $newFilePath !== null
            && $oldFilePath !== null
            && $oldFilePath !== $newFilePath
            && Storage::disk('public')
                ->exists($oldFilePath)
        ) {
            Storage::disk('public')
                ->delete($oldFilePath);
        }

        return redirect()
            ->route('admin.accreditations.index')
            ->with(
                'success',
                'Data akreditasi berhasil diperbarui.'
            );
    }

    /**
     * Menghapus data akreditasi.
     */
    public function destroy(
        Accreditation $accreditation
    ): RedirectResponse {
        $filePath = $accreditation->file_path;

        try {
            /*
            |--------------------------------------------------------------------------
            | HAPUS RECORD TERLEBIH DAHULU
            |--------------------------------------------------------------------------
            |
            | File fisik baru dihapus setelah penghapusan database berhasil.
            |
            */

            DB::transaction(
                static function () use (
                    $accreditation
                ): void {
                    $accreditation->delete();
                }
            );
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('admin.accreditations.index')
                ->with(
                    'error',
                    'Data akreditasi belum dapat dihapus.'
                );
        }

        if (
            $filePath !== null
            && Storage::disk('public')
                ->exists($filePath)
        ) {
            Storage::disk('public')
                ->delete($filePath);
        }

        return redirect()
            ->route('admin.accreditations.index')
            ->with(
                'success',
                'Data akreditasi berhasil dihapus.'
            );
    }

    /**
     * Aturan validasi data akreditasi.
     *
     * @return array<string, mixed>
     */
    private function validationRules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'type' => [
                'required',
                'string',
                Rule::in(
                    array_keys(
                        Accreditation::types()
                    )
                ),
            ],

            'institution' => [
                'nullable',
                'string',
                'max:255',
            ],

            'rank' => [
                'nullable',
                'string',
                'max:255',
            ],

            'certificate_number' => [
                'nullable',
                'string',
                'max:255',
            ],

            'valid_from' => [
                'nullable',
                'date',
            ],

            'valid_until' => [
                'nullable',
                'date',
                'after_or_equal:valid_from',
            ],

            'file_path' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:20480',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }

    /**
     * Pesan validasi data akreditasi.
     *
     * @return array<string, string>
     */
    private function validationMessages(): array
    {
        return [
            'title.required' =>
                'Judul akreditasi wajib diisi.',

            'title.string' =>
                'Judul akreditasi harus berupa teks.',

            'title.max' =>
                'Judul akreditasi maksimal 255 karakter.',

            'type.required' =>
                'Jenis akreditasi wajib dipilih.',

            'type.in' =>
                'Jenis akreditasi yang dipilih tidak valid.',

            'institution.max' =>
                'Nama lembaga maksimal 255 karakter.',

            'rank.max' =>
                'Peringkat akreditasi maksimal 255 karakter.',

            'certificate_number.max' =>
                'Nomor sertifikat maksimal 255 karakter.',

            'valid_from.date' =>
                'Tanggal mulai berlaku tidak valid.',

            'valid_until.date' =>
                'Tanggal akhir berlaku tidak valid.',

            'valid_until.after_or_equal' =>
                'Tanggal akhir berlaku tidak boleh lebih awal dari tanggal mulai.',

            'file_path.file' =>
                'Dokumen akreditasi harus berupa file.',

            'file_path.mimes' =>
                'Dokumen harus berformat PDF, JPG, JPEG, PNG, atau WEBP.',

            'file_path.max' =>
                'Ukuran dokumen maksimal 20 MB.',

            'description.string' =>
                'Deskripsi harus berupa teks.',

            'is_active.boolean' =>
                'Status publikasi tidak valid.',

            'sort_order.integer' =>
                'Urutan harus berupa angka bulat.',

            'sort_order.min' =>
                'Urutan tidak boleh bernilai negatif.',
        ];
    }

    /**
     * Membersihkan input teks sebelum validasi.
     */
    private function normalizeInput(
        Request $request
    ): void {
        $request->merge([
            'title' => trim(
                (string) $request->input('title')
            ),

            'type' => trim(
                (string) $request->input('type')
            ),

            'institution' =>
                $this->nullableText(
                    $request->input('institution')
                ),

            'rank' =>
                $this->nullableText(
                    $request->input('rank')
                ),

            'certificate_number' =>
                $this->nullableText(
                    $request->input(
                        'certificate_number'
                    )
                ),

            'description' =>
                $this->nullableText(
                    $request->input('description')
                ),

            'is_active' =>
                $request->boolean('is_active'),

            'sort_order' =>
                $request->filled('sort_order')
                    ? $request->input('sort_order')
                    : 0,
        ]);
    }

    /**
     * Mengubah teks kosong menjadi null.
     */
    private function nullableText(
        mixed $value
    ): ?string {
        $normalized = trim(
            (string) $value
        );

        return $normalized !== ''
            ? $normalized
            : null;
    }
}