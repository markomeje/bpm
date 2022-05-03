<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Profile, User};

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::truncate();
        Profile::factory()->count(User::count())->create();
    }
}
