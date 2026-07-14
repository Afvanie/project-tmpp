<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicDocument;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class AcademicDocumentController extends Controller
{
    /**
     * Menampilkan seluruh dokumen akademik.
     */
    public function index(): View
    {
        $documents = AcademicDocument::query()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.academic-documents.index', [
            'documents' => $documents,
        ]);
    }

    /**
     * Menampilkan formulir tambah dokumen.
     */
    public function create(): View
    {
        return view('admin.academic-documents.create', [
            'categories' => AcademicDocument::categories(),
        ]);
    }

    /**
     * Menyimpan dokumen akademik baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateDocument($request);

        $filePath = null;

        if ($request->hasFile('file_path')) {
            $filePath = $request
                ->file('file_path')
                ->store('academic-documents', 'public');
        }

        try {
            AcademicDocument::query()->create([
                'title' => $validated['title'],
                'category' => $validated['category'],
                'description' => $this->nullableString(
                    $validated['description'] ?? null
                ),
                'file_path' => $filePath,
                'external_link' => $this->nullableString(
                    $validated['external_link'] ?? null
                ),
                'academic_year' => $this->nullableString(
                    $validated['academic_year'] ?? null
                ),
                'is_active' => $request->boolean('is_active'),
                'sort_order' => $validated['sort_order'] ?? 0,
            ]);
        } catch (Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | Bersihkan file jika penyimpanan database gagal
            |--------------------------------------------------------------------------
            */

            if (
                $filePath
                && Storage::disk('public')->exists($filePath)
            ) {
                Storage::disk('public')->delete($filePath);
            }

            throw $exception;
        }

        return redirect()
            ->route('admin.academic-documents.index')
            ->with(
                'success',
                'Dokumen akademik berhasil ditambahkan.'
            );
    }

    /**
     * Menampilkan formulir edit dokumen.
     */
    public function edit(
        AcademicDocument $academicDocument
    ): View {
        return view('admin.academic-documents.edit', [
            'academicDocument' => $academicDocument,
            'categories' => AcademicDocument::categories(),
        ]);
    }

    /**
     * Memperbarui dokumen akademik.
     */
    public function update(
        Request $request,
        AcademicDocument $academicDocument
    ): RedirectResponse {
        $validated = $this->validateDocument($request);

        $oldFilePath = $academicDocument->file_path;
        $newFilePath = null;

        /*
        |--------------------------------------------------------------------------
        | Simpan file baru terlebih dahulu
        |--------------------------------------------------------------------------
        |
        | File lama belum dihapus pada tahap ini. Dengan demikian, file lama
        | masih aman apabila proses penyimpanan file baru mengalami kegagalan.
        |
        */

        if ($request->hasFile('file_path')) {
            $newFilePath = $request
                ->file('file_path')
                ->store('academic-documents', 'public');
        }

        $finalFilePath = $newFilePath ?: $oldFilePath;

        try {
            $academicDocument->update([
                'title' => $validated['title'],
                'category' => $validated['category'],
                'description' => $this->nullableString(
                    $validated['description'] ?? null
                ),
                'file_path' => $finalFilePath,
                'external_link' => $this->nullableString(
                    $validated['external_link'] ?? null
                ),
                'academic_year' => $this->nullableString(
                    $validated['academic_year'] ?? null
                ),
                'is_active' => $request->boolean('is_active'),
                'sort_order' => $validated['sort_order'] ?? 0,
            ]);
        } catch (Throwable $exception) {
            /*
            |--------------------------------------------------------------------------
            | Hapus file baru apabila update database gagal
            |--------------------------------------------------------------------------
            */

            if (
                $newFilePath
                && Storage::disk('public')->exists($newFilePath)
            ) {
                Storage::disk('public')->delete($newFilePath);
            }

            throw $exception;
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus file lama setelah database berhasil diperbarui
        |--------------------------------------------------------------------------
        */

        if (
            $newFilePath
            && $oldFilePath
            && $oldFilePath !== $newFilePath
            && Storage::disk('public')->exists($oldFilePath)
        ) {
            Storage::disk('public')->delete($oldFilePath);
        }

        return redirect()
            ->route('admin.academic-documents.index')
            ->with(
                'success',
                'Dokumen akademik berhasil diperbarui.'
            );
    }

    /**
     * Menghapus dokumen akademik.
     */
    public function destroy(
        AcademicDocument $academicDocument
    ): RedirectResponse {
        $filePath = $academicDocument->file_path;

        /*
        |--------------------------------------------------------------------------
        | Hapus data database terlebih dahulu
        |--------------------------------------------------------------------------
        |
        | Hal ini mencegah file hilang sementara record database gagal dihapus.
        |
        */

        $academicDocument->delete();

        if (
            $filePath
            && Storage::disk('public')->exists($filePath)
        ) {
            Storage::disk('public')->delete($filePath);
        }

        return redirect()
            ->route('admin.academic-documents.index')
            ->with(
                'success',
                'Dokumen akademik berhasil dihapus.'
            );
    }

    /**
     * Validasi dokumen akademik.
     *
     * Maksimal file dipertahankan 20 MB agar dokumen kurikulum
     * atau pedoman PDF berukuran besar tetap dapat diunggah.
     */
    private function validateDocument(Request $request): array
    {
        return $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'required',
                Rule::in(
                    array_keys(AcademicDocument::categories())
                ),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'file_path' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:20480',
            ],

            'external_link' => [
                'nullable',
                'url',
                'max:2048',
                'regex:/^https?:\/\//i',
            ],

            'academic_year' => [
                'nullable',
                'string',
                'max:50',
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
        ], [
            'external_link.regex' =>
                'Tautan eksternal harus menggunakan http:// atau https://.',

            'file_path.mimes' =>
                'File harus berformat PDF, JPG, JPEG, PNG, atau WEBP.',

            'file_path.max' =>
                'Ukuran file maksimal adalah 20 MB.',

            'category.in' =>
                'Kategori dokumen akademik tidak valid.',
        ]);
    }

    /**
     * Mengubah string kosong menjadi null.
     */
    private function nullableString(
        mixed $value
    ): ?string {
        $value = trim((string) $value);

        return $value !== '' ? $value : null;
    }
}