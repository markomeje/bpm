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
        $faker = Faker::create();
        if(env('APP_ENV') === 'production') {
            $user = User::create([
                'name' => 'Super Admin', 
                'phone' => '08060545860', 
                'email' => 'nnam.ug@gmail.com', 
                'role' => 'admin', 
                'password' => Hash::make('!nnam.ug.360!.'), 
                'status' => 'active',
                'type' => 'staff',
            ]);

            Staff::create([
                'user_id' => $user->id,
                'type' => 'main',
                'role' => 'superadmin',
                'verified' => true,
                'status' => 'active',
            ]);
        }else {
            $users = [
                ['name' => $faker->name(), 'phone' => $faker->phoneNumber(), 'email' => 'admin@admin.io', 'role' => 'admin', 'password' => Hash::make('1234'), 'status' => 'active'],
                ['name' => $faker->name(), 'phone' => $faker->phoneNumber(), 'email' => 'user@user.io', 'role' => 'user', 'password' => Hash::make('1234'), 'status' => 'active'],
                ['name' => $faker->name(), 'phone' => $faker->phoneNumber(), 'email' => 'blogger@blogger.io', 'role' => 'blogger', 'password' => Hash::make('1234'), 'status' => 'active'],
            ];

            User::truncate();
            User::factory()->count(312)->create();
            foreach ($users as $user) {
                User::create($user);
            }

        }
    }
}
