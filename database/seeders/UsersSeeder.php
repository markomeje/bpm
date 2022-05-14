<?php

namespace Database\Seeders;
use App\Models\{User, Staff};
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_ENV') !== 'production') {
            $faker = Faker::create();
            $users = [
                ['name' => $faker->name(), 'phone' => $faker->phoneNumber(), 'email' => 'admin@admin.io', 'role' => 'admin', 'password' => Hash::make('1234'), 'status' => 'active'],
                ['name' => $faker->name(), 'phone' => $faker->phoneNumber(), 'email' => 'user@user.io', 'role' => 'user', 'password' => Hash::make('1234'), 'status' => 'active'],
                ['name' => $faker->name(), 'phone' => $faker->phoneNumber(), 'email' => 'blogger@blogger.io', 'role' => 'blogger', 'password' => Hash::make('1234'), 'status' => 'active'],
                ['name' => $faker->name(), 'phone' => $faker->phoneNumber(), 'email' => 'super@super.io', 'role' => 'superadmin', 'password' => Hash::make('1234'), 'status' => 'active'],
            ];

            User::truncate();
            User::factory()->count(312)->create();
            foreach ($users as $user) {
                User::create($user);
            }

        }
    }
}
