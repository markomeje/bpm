<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Review, Profile};
   
class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::truncate();
        Review::factory()->count(Profile::count() * 4)->create();
    }
}