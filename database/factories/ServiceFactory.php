<?php

namespace Database\Factories;
use App\Models\{Skill, User, Currency};
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class ServiceFactory extends Factory
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
            'description' => $faker->text($maxNbChars = 200),
            'price' => $faker->numberBetween(2000, 11000),
            'skill_id' => rand(1, Skill::count()),
            'currency_id' => rand(1, Currency::count()),
            'status' => 'active',
            'clicks' => $faker->numberBetween(40, 670),
        ];
    }
}
