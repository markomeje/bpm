<?php

namespace Database\Factories;
use App\Models\{Property, Currency, User, Country};
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Carbon\Carbon;

class PropertyFactory extends Factory
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
            'condition' => $faker->randomElement(Property::$conditions),
            'user_id' => $faker->numberBetween(1, User::count()),
            'address' => $faker->address(),
            'price' => $faker->numberBetween(10000000, 9000000000),
            'action' => $faker->randomElement(array_keys(Property::$actions)),
            'country_id' => $faker->numberBetween(1, Country::count()),
            'bedrooms' => $faker->numberBetween(3, 5),
            'status' => $faker->randomElement(Property::$status),
            'state' => $faker->state(),
            'toilets' => $faker->numberBetween(4, 11),
            'bathrooms' => $faker->numberBetween(3, 15),
            'category' => $faker->randomElement(array_keys(Property::$categories)),
            'group' => $faker->randomElement(['dulplex', 'bungalow', 'Land', 'Flat', 'Self-Contain', 'Auditorium', 'Terrace', 'Event Center', 'Shop']),
            'currency_id' => $faker->numberBetween(1, Currency::count()),
            'reference' => \Str::random(64),
            'measurement' => $faker->numberBetween(500, 6500),
            'city' => $faker->city(),
            'additional' => $faker->text($maxNbChars = 400),
        ];
    }
}
