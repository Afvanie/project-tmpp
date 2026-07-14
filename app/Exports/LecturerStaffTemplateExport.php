<?php

declare(strict_types=1);

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LecturerStaffTemplateExport extends StringValueBinder implements
    FromArray,
    WithHeadings,
    WithCustomValueBinder,
    WithColumnFormatting,
    WithColumnWidths,
    WithStyles
{
    /**
     * Judul kolom yang dikenali oleh proses import.
     */
    public function headings(): array
    {
        return [
            'nama',
            'nip',
        ];
    }

    /**
     * Contoh data pada template.
     *
     * Data ini hanya contoh dan dapat dihapus atau diganti
     * oleh pengelola sebelum proses import.
     */
    public function array(): array
    {
        return [
            [
                'Contoh Nama Personel, S.T., M.T.',
                '198701012015041001',
            ],
            [
                'Contoh Nama Tanpa NIP',
                '',
            ],
        ];
    }

    /**
     * Menetapkan kolom NIP sebagai teks.
     */
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    /**
     * Menetapkan lebar kolom agar template mudah dibaca.
     */
    public function columnWidths(): array
    {
        return [
            'A' => 45,
            'B' => 24,
        ];
    }

    /**
     * Mengatur tampilan dasar template.
     */
    public function styles(Worksheet $sheet): array
    {
        /*
        |--------------------------------------------------------------------------
        | Bekukan baris judul
        |--------------------------------------------------------------------------
        */

        $sheet->freezePane('A2');

        $sheet->getRowDimension(1)
            ->setRowHeight(24);

        /*
        |--------------------------------------------------------------------------
        | Format seluruh kolom NIP sebagai teks
        |--------------------------------------------------------------------------
        */

        $sheet->getStyle('B:B')
            ->getNumberFormat()
            ->setFormatCode(
                NumberFormat::FORMAT_TEXT
            );

        return [
            /*
            |--------------------------------------------------------------------------
            | Baris heading
            |--------------------------------------------------------------------------
            */

            1 => [
                'font' => [
                    'bold' => true,
                ],

                'alignment' => [
                    'horizontal' =>
                        Alignment::HORIZONTAL_CENTER,

                    'vertical' =>
                        Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}