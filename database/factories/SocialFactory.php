<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Profile, Social};
use Faker\Factory as Faker;

class SocialFactory extends Factory
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
            'link' => $faker->url(),
            'company' => $faker->randomElement(Social::$companies),
            'username' => $faker->username(),
            'user_id' => rand(1, Profile::count()),
            'phone' => $faker->phoneNumber(),
        ];
    }
}
