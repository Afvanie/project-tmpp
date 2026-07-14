<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel dokumentasi foto fasilitas.
     */
    public function up(): void
    {
        Schema::create(
            'facility_photos',
            function (Blueprint $table): void {
                $table->id();

                /*
                |--------------------------------------------------------------------------
                | RELASI KATEGORI FASILITAS
                |--------------------------------------------------------------------------
                */

                $table
                    ->foreignId('facility_id')
                    ->constrained('facilities')
                    ->cascadeOnDelete();

                /*
                |--------------------------------------------------------------------------
                | INFORMASI FOTO
                |--------------------------------------------------------------------------
                */

                $table
                    ->string('title')
                    ->nullable();

                $table->string('photo');

                /*
                |--------------------------------------------------------------------------
                | PENGATURAN TAMPILAN
                |--------------------------------------------------------------------------
                */

                $table
                    ->unsignedInteger('sort_order')
                    ->default(0);

                $table
                    ->boolean('is_active')
                    ->default(true);

                $table->timestamps();

                /*
                |--------------------------------------------------------------------------
                | INDEX HALAMAN PUBLIK
                |--------------------------------------------------------------------------
                */

                $table->index(
                    [
                        'facility_id',
                        'is_active',
                        'sort_order',
                    ],
                    'facility_photos_display_index'
                );
            }
        );
    }

    /**
     * Menghapus tabel dokumentasi foto fasilitas.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_photos');
    }
};