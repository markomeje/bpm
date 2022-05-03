<?php

namespace Database\Seeders;
use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::truncate();
        Blog::factory()->count(547)->create();
    }
}
