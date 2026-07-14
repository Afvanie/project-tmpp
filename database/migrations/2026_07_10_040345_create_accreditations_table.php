<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel data akreditasi.
     */
    public function up(): void
    {
        Schema::create(
            'accreditations',
            function (Blueprint $table): void {
                $table->id();

                $table
                    ->string('title', 255)
                    ->comment('Judul data akreditasi');

                /*
                |--------------------------------------------------------------------------
                | JENIS AKREDITASI
                |--------------------------------------------------------------------------
                |
                | Nilai awal yang didukung:
                |
                | - nasional
                | - internasional
                |
                | Digunakan string, bukan enum, agar lebih portabel dan mudah
                | dikembangkan tanpa mengubah struktur kolom.
                |
                */

                $table
                    ->string('type', 30)
                    ->default('nasional')
                    ->comment('Jenis akreditasi');

                $table
                    ->string('institution', 255)
                    ->nullable()
                    ->comment('Lembaga pemberi akreditasi');

                $table
                    ->string('rank', 255)
                    ->nullable()
                    ->comment('Peringkat atau status akreditasi');

                $table
                    ->string('certificate_number', 255)
                    ->nullable()
                    ->comment('Nomor sertifikat atau keputusan');

                $table
                    ->date('valid_from')
                    ->nullable()
                    ->comment('Tanggal mulai berlaku');

                $table
                    ->date('valid_until')
                    ->nullable()
                    ->comment('Tanggal akhir berlaku');

                $table
                    ->string('file_path', 500)
                    ->nullable()
                    ->comment('Lokasi file sertifikat pada public storage');

                $table
                    ->text('description')
                    ->nullable()
                    ->comment('Keterangan tambahan');

                $table
                    ->boolean('is_active')
                    ->default(true)
                    ->comment('Status publikasi');

                $table
                    ->unsignedInteger('sort_order')
                    ->default(0)
                    ->comment('Urutan tampilan');

                $table->timestamps();

                /*
                |--------------------------------------------------------------------------
                | INDEX
                |--------------------------------------------------------------------------
                */

                $table
                    ->index(
                        'type',
                        'accreditations_type_index'
                    );

                $table
                    ->index(
                        [
                            'is_active',
                            'sort_order',
                        ],
                        'accreditations_active_sort_index'
                    );
            }
        );
    }

    /**
     * Menghapus tabel data akreditasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('accreditations');
    }
};