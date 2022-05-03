<?php

namespace Database\Factories;
use App\Models\{Material, User, Currency, Country};
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Faker\Factory as Faker;

class MaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        return [
            'user_id' => rand(1, User::count()),
            'address' => $faker->address(),
            'name' => $faker->sentence(),
            'price' => $faker->numberBetween(2000, 11000),
            'country_id' => rand(1, Country::count()),
            'status' => $faker->randomElement(Material::$status),
            'state' => $faker->state(),
            'currency_id' => rand(1, Currency::count()),
            'quantity' => $faker->numberBetween(25, 89),
            'reference' => \Str::uuid(),
            'city' => $faker->city(),
            'additional' => $faker->paragraph(15),
        ];
    }
}
