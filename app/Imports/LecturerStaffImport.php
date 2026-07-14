<?php

declare(strict_types=1);

namespace App\Imports;

use App\Models\LecturerStaff;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use RuntimeException;

class LecturerStaffImport implements
    ToCollection,
    WithHeadingRow,
    SkipsEmptyRows
{
    /**
     * Jenis personel yang akan diterapkan pada seluruh data import.
     *
     * Nilai internal:
     * - dosen
     * - staff
     */
    public function __construct(
        protected readonly string $type
    ) {
        if (
            !in_array(
                $this->type,
                [
                    LecturerStaff::TYPE_DOSEN,
                    LecturerStaff::TYPE_STAFF,
                ],
                true
            )
        ) {
            throw new InvalidArgumentException(
                'Jenis personel untuk proses import tidak valid.'
            );
        }
    }

    /**
     * Memproses seluruh baris dari file Excel atau CSV.
     */
    public function collection(Collection $rows): void
    {
        if ($rows->isEmpty()) {
            throw new RuntimeException(
                'File import tidak berisi data dosen atau staf.'
            );
        }

        $this->validateHeading($rows);

        DB::transaction(function () use ($rows): void {
            foreach ($rows as $row) {
                $name = $this->normalizeName(
                    $row['nama']
                        ?? $row['name']
                        ?? $row['nama_lengkap']
                        ?? null
                );

                $nip = $this->normalizeNip(
                    $row['nip'] ?? null
                );

                /*
                |--------------------------------------------------------------------------
                | LEWATI BARIS TANPA NAMA
                |--------------------------------------------------------------------------
                */

                if ($name === '') {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | DATA DENGAN NIP
                |--------------------------------------------------------------------------
                |
                | Apabila NIP tersedia, data dicari berdasarkan kombinasi:
                |
                | - NIP
                | - jenis personel
                |
                | Nama akan diperbarui apabila datanya sudah ada.
                | Foto yang sebelumnya tersimpan tidak akan diubah.
                |
                */

                if ($nip !== null) {
                    LecturerStaff::query()->updateOrCreate(
                        [
                            'nip' => $nip,
                            'type' => $this->type,
                        ],
                        [
                            'name' => $name,
                        ]
                    );

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | DATA TANPA NIP
                |--------------------------------------------------------------------------
                |
                | Apabila NIP kosong, pencarian dilakukan berdasarkan:
                |
                | - nama
                | - jenis personel
                |
                */

                LecturerStaff::query()->updateOrCreate(
                    [
                        'name' => $name,
                        'type' => $this->type,
                    ],
                    [
                        'nip' => null,
                    ]
                );
            }
        });
    }

    /**
     * Memastikan file memiliki kolom nama.
     */
    private function validateHeading(Collection $rows): void
    {
        $firstRow = $rows->first();

        if ($firstRow instanceof Collection) {
            $headings = $firstRow
                ->keys()
                ->map(
                    fn (mixed $heading): string =>
                        strtolower(
                            trim((string) $heading)
                        )
                );
        } else {
            $headings = collect(
                array_keys((array) $firstRow)
            )->map(
                fn (mixed $heading): string =>
                    strtolower(
                        trim((string) $heading)
                    )
            );
        }

        $hasNameHeading = $headings->contains('nama')
            || $headings->contains('name')
            || $headings->contains('nama_lengkap');

        if (!$hasNameHeading) {
            throw new RuntimeException(
                'Kolom nama tidak ditemukan. Gunakan template import yang tersedia.'
            );
        }
    }

    /**
     * Membersihkan dan membatasi nama personel.
     */
    private function normalizeName(mixed $value): string
    {
        $name = trim((string) ($value ?? ''));

        $name = preg_replace(
            '/\s+/u',
            ' ',
            $name
        ) ?? '';

        return mb_substr(
            $name,
            0,
            255
        );
    }

    /**
     * Membersihkan dan membatasi NIP.
     */
    private function normalizeNip(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | NILAI NUMERIK DARI EXCEL
        |--------------------------------------------------------------------------
        |
        | Nilai numerik terkadang dibaca sebagai integer atau float.
        | Format tanpa desimal digunakan agar tidak tersimpan sebagai "123.0".
        |
        | Untuk NIP panjang, kolom pada template tetap harus menggunakan
        | format Text agar Excel tidak mengubah atau membulatkan angkanya.
        |
        */

        if (is_int($value)) {
            $nip = (string) $value;
        } elseif (is_float($value)) {
            $nip = number_format(
                $value,
                0,
                '',
                ''
            );
        } else {
            $nip = trim((string) $value);
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus karakter spasi di antara angka NIP
        |--------------------------------------------------------------------------
        */

        $nip = preg_replace(
            '/\s+/u',
            '',
            $nip
        ) ?? '';

        /*
        |--------------------------------------------------------------------------
        | Hapus akhiran desimal kosong
        |--------------------------------------------------------------------------
        |
        | Contoh:
        | 198701012020121001.0
        | menjadi:
        | 198701012020121001
        |
        */

        if (
            preg_match('/^\d+\.0+$/', $nip) === 1
        ) {
            $nip = preg_replace(
                '/\.0+$/',
                '',
                $nip
            ) ?? $nip;
        }

        $nip = trim($nip);

        if ($nip === '') {
            return null;
        }

        return mb_substr(
            $nip,
            0,
            100
        );
    }
}