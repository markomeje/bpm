<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Profile, User, Country};
use Faker\Factory as Faker;

class ProfileFactory extends Factory
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
            'designation' => $faker->randomElement(Profile::$designations),
            'user_id' => $faker->numberBetween(1, User::count()),
            'address' => $faker->address(),
            'type' => $faker->randomElement(Profile::$types),
            'country_id' => $faker->numberBetween(1, Country::count()),
            'website' => $faker->url(),
            'status' => $faker->randomElement(Profile::$status),
            'state' => $faker->state(),
            'email' => $faker->safeEmail(),
            'idnumber' => $faker->numberBetween(11, 15),
            'rcnumber' => $faker->numberBetween(5, 6),
            'role' => $faker->randomElement(array_keys(Profile::$roles)),
            'certified' => $faker->boolean($chanceOfGettingTrue = 18),
            'reference' => \Str::random(64),
            'code' => $faker->randomElement(['red', 'bmd', 'rea', 'ats', 'rel']),
            'description' => $faker->text(),
            'city' => $faker->city(),
            'phone' => $faker->phoneNumber(),
        ];
    }
}
