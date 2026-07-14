<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Membuat atau memperbarui akun admin utama.
     */
    public function run(): void
    {
        Admin::query()->updateOrCreate(
            [
                'email' => 'admin@polinema.com',
            ],
            [
                'name' => 'Administrator TMPP',
                'password' => 'admin123',
            ]
        );
    }
}