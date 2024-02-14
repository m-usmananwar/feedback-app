<?php

namespace Database\Seeders;

use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Bug Report',
            'Feature',
            'Improvement',
            'Ready For QA',
            'Development',
            'Production',
        ];
        for($i = 1; $i <= 10; $i++) {
            $randomIndex = array_rand($categories);

            Feedback::create([
                'title' => "Unique title {$i}",
                'description' => "Unique description {$i}",
                'user_id' => 1 , // as now only one user exists
                'category' => $categories[$randomIndex]
            ]);
        }
    }
}
