<?php

namespace Database\Factories;
use App\Models\{Membership, Unit, Currency, Payment};
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class UnitFactory extends Factory
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
            'price' => $faker->numberBetween(50, 2500),
            'duration' => $faker->numberBetween(1, 360), //1day - 360days
            'status' => $faker->randomElement(Unit::$status),
            'currency_id' => rand(1, Currency::count()),
            'units' => $faker->numberBetween(10, 900),
            'reference' => \Str::uuid(),
        ];
    }
}
