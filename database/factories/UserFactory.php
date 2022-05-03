<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class UserFactory extends Factory
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
            'name' => $faker->name(),
            'phone' => $faker->phoneNumber(),
            'email' => $faker->unique()->safeEmail(),
            'role' => 'user',
            'password' => \Hash::make('1234'),
            'remember_token' => \Str::random(32),
            'status' => $faker->randomElement(User::$status),
            'type' => $faker->randomElement(['individual', 'company']),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
