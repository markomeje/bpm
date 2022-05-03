<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Credit, User};

class CreditsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Credit::truncate();
        Credit::factory()->count(370)->create();
    }
}
