<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DestinationSeeder::class);
        $this->command->info('Destinations table seeded!');

        $this->call(ReviewSeeder::class);
        $this->command->info('Destinations table seeded!');
    }
}
