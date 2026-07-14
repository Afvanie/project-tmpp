<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,

            HomeContentSeeder::class,

            ProfileOverviewSeeder::class,
            ProfileHistorySeeder::class,
            ProfileContentSeeder::class,

            FacilitySeeder::class,
        ]);
    }
}