<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Material;
   
class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Material::truncate();
        Material::factory()->count(240)->create();
    }
}