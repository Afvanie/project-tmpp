<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel kategori fasilitas.
     */
    public function up(): void
    {
        Schema::create(
            'facilities',
            function (Blueprint $table): void {
                $table->id();

                /*
                |--------------------------------------------------------------------------
                | INFORMASI FASILITAS
                |--------------------------------------------------------------------------
                */

                $table
                    ->string('category')
                    ->unique();

                $table->string('title');

                $table
                    ->text('description')
                    ->nullable();

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
                    ['is_active', 'sort_order'],
                    'facilities_active_sort_index'
                );
            }
        );
    }

    /**
     * Menghapus tabel kategori fasilitas.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};