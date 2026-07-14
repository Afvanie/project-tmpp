<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Exports\LecturerStaffTemplateExport;
use App\Http\Controllers\Controller;
use App\Imports\LecturerStaffImport;
use App\Models\LecturerStaff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class LecturerStaffImportController extends Controller
{
    /**
     * Mengunduh template import data dosen dan staf.
     */
    public function template(): BinaryFileResponse
    {
        return Excel::download(
            new LecturerStaffTemplateExport(),
            'template-import-dosen-staf.xlsx'
        );
    }

    /**
     * Mengimpor data dosen atau staf dari Excel/CSV.
     */
    public function import(
        Request $request,
        string $type
    ): RedirectResponse {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI JENIS PERSONEL
        |--------------------------------------------------------------------------
        |
        | Nilai internal tetap:
        |
        | - dosen
        | - staff
        |
        */

        abort_unless(
            in_array(
                $type,
                [
                    LecturerStaff::TYPE_DOSEN,
                    LecturerStaff::TYPE_STAFF,
                ],
                true
            ),
            404
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDASI FILE
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:5120',
            ],
        ], [
            'file.required' =>
                'File Excel atau CSV wajib dipilih.',

            'file.file' =>
                'File import yang dipilih tidak valid.',

            'file.mimes' =>
                'File harus berformat XLSX, XLS, atau CSV.',

            'file.max' =>
                'Ukuran file import maksimal adalah 5 MB.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PROSES IMPORT
        |--------------------------------------------------------------------------
        */

        try {
            Excel::import(
                new LecturerStaffImport($type),
                $validated['file']
            );
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Proses import gagal. Periksa kembali format dan isi file yang digunakan.'
                );
        }

        $label = $type === LecturerStaff::TYPE_DOSEN
            ? 'Dosen'
            : 'Staf';

        return redirect()
            ->route('admin.lecturer-staff.index')
            ->with(
                'success',
                "Data {$label} berhasil diimpor."
            );
    }
}