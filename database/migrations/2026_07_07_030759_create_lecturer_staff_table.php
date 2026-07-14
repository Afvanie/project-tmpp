<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel data dosen dan staf.
     */
    public function up(): void
    {
        Schema::create(
            'lecturer_staff',
            function (Blueprint $table): void {
                $table->id();

                /*
                |--------------------------------------------------------------------------
                | INFORMASI PERSONEL
                |--------------------------------------------------------------------------
                */

                $table->string('name');

                $table
                    ->string('nip', 100)
                    ->nullable();

                $table
                    ->string('photo')
                    ->nullable();

                /*
                |--------------------------------------------------------------------------
                | JENIS PERSONEL
                |--------------------------------------------------------------------------
                |
                | Nilai internal:
                |
                | - dosen
                | - staff
                |
                | Tulisan yang ditampilkan kepada pengguna untuk "staff"
                | tetap menggunakan istilah Bahasa Indonesia, yaitu "Staf".
                |
                */

                $table
                    ->string('type', 20)
                    ->default('dosen');

                $table->timestamps();

                /*
                |--------------------------------------------------------------------------
                | INDEX
                |--------------------------------------------------------------------------
                |
                | Index membantu proses pencarian, filter, pengurutan,
                | dan pencocokan data pada proses import.
                |
                */

                $table->index(
                    'nip',
                    'lecturer_staff_nip_index'
                );

                $table->index(
                    ['type', 'name'],
                    'lecturer_staff_type_name_index'
                );
            }
        );
    }

    /**
     * Menghapus tabel data dosen dan staf.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer_staff');
    }
};