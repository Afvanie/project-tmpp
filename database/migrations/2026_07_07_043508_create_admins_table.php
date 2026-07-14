<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel akun pengelola admin.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table): void {
            $table->id();

            $table
                ->string('name', 255)
                ->comment('Nama pengelola website');

            $table
                ->string('email', 255)
                ->unique()
                ->comment('Email yang digunakan untuk login admin');

            $table
                ->string('password', 255)
                ->comment('Hash kata sandi akun admin');

            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel akun pengelola admin.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};