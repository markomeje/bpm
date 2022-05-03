<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Social, Profile};

class SocialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Social::truncate();
        Social::factory()->count(Profile::count() * 7)->create();
    }
}
