<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 50) as $i) {
            DB::table('posts')->insert([
                'post_user' => \App\Models\User::inRandomOrder()->first()->id,
                'post_category_id' => \App\Models\Category::inRandomOrder()->first()->id,
                'name' => 'Post ' . $i,
                'status' => rand(1, 2),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}
