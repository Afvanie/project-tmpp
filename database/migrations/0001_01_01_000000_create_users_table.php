<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel pengguna bawaan, token reset, dan session.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table): void {
            $table->id();

            $table->string('name', 255);

            $table
                ->string('email', 255)
                ->unique();

            $table
                ->timestamp('email_verified_at')
                ->nullable();

            $table->string('password', 255);

            $table->rememberToken();

            $table->timestamps();
        });


        Schema::create(
            'password_reset_tokens',
            function (Blueprint $table): void {
                $table
                    ->string('email', 255)
                    ->primary();

                $table->string('token', 255);

                $table
                    ->timestamp('created_at')
                    ->nullable();
            }
        );


        Schema::create(
            'sessions',
            function (Blueprint $table): void {
                $table
                    ->string('id', 255)
                    ->primary();

                /*
                |--------------------------------------------------------------------------
                | USER ID
                |--------------------------------------------------------------------------
                |
                | Akan bernilai null untuk login admin TMPP karena autentikasi
                | admin menggunakan session khusus admin_id.
                |
                */

                $table
                    ->foreignId('user_id')
                    ->nullable()
                    ->index();

                $table
                    ->string('ip_address', 45)
                    ->nullable();

                $table
                    ->text('user_agent')
                    ->nullable();

                $table->longText('payload');

                $table
                    ->integer('last_activity')
                    ->index();
            }
        );
    }

    /**
     * Menghapus tabel dalam urutan kebalikan pembuatannya.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};