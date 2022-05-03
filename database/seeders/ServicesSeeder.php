<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Service, Profile};

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::truncate();
        Service::factory()->count(Profile::count() * 7)->create();
    }
}
