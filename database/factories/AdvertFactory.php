<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Credit, User, Advert};
use Illuminate\Support\Str;
use Carbon\Carbon;
use Faker\Factory as Faker;

class AdvertFactory extends Factory
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
            'description' => $faker->sentence(),
            'user_id' => rand(1, User::count()),
            'clicks' => $faker->numberBetween(103, 765),
            'link' => $faker->url(),
            'size' => $faker->randomElement(['fhb', 'ssb', 'svb']),
            'credit_id' => rand(1, Credit::count()),
            'reference' => Str::random(64),
            'status' => $faker->randomElement(['initialized', 'expired']),
        ];
    }
}
