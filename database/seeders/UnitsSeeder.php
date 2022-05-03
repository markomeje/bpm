<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::truncate();
        Unit::factory()->count(15)->create();
    }
}
