<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(config('app.env') !== 'production') {
            $this->call([
                MembershipsSeeder::class,
                UsersSeeder::class,
                CurrenciesSeeder::class,
                PropertiesSeeder::class,
                BlogsSeeder::class,
                MaterialsSeeder::class,
                PaymentsSeeder::class,
                PaymentsSeeder::class,
                NewsSeeder::class,
                UnitsSeeder::class,
                CreditsSeeder::class,
                ReviewsSeeder::class,
                ReviewsSeeder::class,
                ServicesSeeder::class,
                AdvertsSeeder::class,
                ProfilesSeeder::class,
                ProfilesSeeder::class,
                CountriesSeeder::class,
            ]);
        }
    }
}
