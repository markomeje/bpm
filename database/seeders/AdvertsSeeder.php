<?php

namespace Database\Seeders;
use App\Models\{Advert, Credit};
use Illuminate\Database\Seeder;

class AdvertsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Advert::truncate();
        Advert::factory()->count(Credit::count() * 4)->create();
    }
}
