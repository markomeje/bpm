<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Review, User, Profile};
use Faker\Factory as Faker;


class ReviewFactory extends Factory
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
            'review' => $faker->text($maxNbChars = 500),
            'status' => $faker->randomElement(Review::$status),
            'user_id' => rand(1, User::count()), //The user that reviewed
            'profile_id' => rand(1, Profile::count()), // The reviewed profile
        ];
    }
}
