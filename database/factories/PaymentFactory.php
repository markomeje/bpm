<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{Payment, User, Currency};
use Faker\Factory as Faker;

class PaymentFactory extends Factory
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
            'amount' => $faker->numberBetween(1000, 9500),
            'status' => $faker->randomElement(Payment::$status),
            'type' => $faker->randomElement(Payment::$types),
            'user_id' => rand(1, User::count()),
            'reference' => \Str::uuid(),
            'currency_id' => rand(1, Currency::count()),
        ];
    }
}
