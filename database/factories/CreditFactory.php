<?php

namespace Database\Factories;
use Faker\Factory as Faker;
use App\Models\{User, Payment, Unit};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CreditFactory extends Factory
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
            'status' => 'available',
            'user_id' => rand(1, User::count()),
            'units' => $faker->numberBetween(50, 300),
            'duration' => $faker->numberBetween(7, 35),
            'reference' => Str::random(64),
            'unit_id' => rand(1, Unit::count()),
            'inuse' => false,
            'payment_id' => rand(1, Payment::count()),
        ];
    }

}
