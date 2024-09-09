<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Review::all()->count() > 0) {
            return;
        }

        // #1 fixed review
        Review::create([
            'name' => 'Lauro Mattos',
            'picture' => 'img/user-01.png',
            'review' => "Miles Journey was one of the best travel agencies I have ever experienced. The customer service was exceptional, and the entire staff was very attentive and helpful."
        ]);

        // #2 fixed review
        Review::create([
            'name' => 'Thalita Magalhaes',
            'picture' => 'img/user-02.png',
            'review' => "I highly recommend Miles Journey agency. They offer a personalized and high quality service that exceeded my expectations on my last trip."
        ]);

        // #3 fixed review
        Review::create([
            'name' => 'Marianna Faustino',
            'picture' => 'img/user-03.png',
            'review' => "My trip with Miles Journey was incredible! I highly recommend the agency to anyone looking for an exciting and personalized experience based on our needs."
        ]);
    }
}
