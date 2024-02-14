<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 10; $i++) {
            Comment::create([
                'commentable_type' => 'Feedback',
                'commentable_id' => rand(1, 9),
                'content' => "Unique comment {$i}",
                'user_id' => 1 // as only one user exists
            ]);
        }
    }
}
