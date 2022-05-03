<?php

namespace Database\Factories;
use App\Models\{Membership, Subscription, User, Payment};
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = Faker::create();
        $duration = array_rand(array_flip(Membership::$durations));
        return [
            'duration' => $duration,
            'status' => $faker->randomElement(Subscription::$status),
            'user_id' => rand(1, User::count()),
            'renewals' => $faker->numberBetween(2, 9),
            'reference' => Str::random(64),
            'payment_id' => rand(1, Payment::count()),
            'started' => Carbon::now(),
            'membership_id' => rand(1, Membership::count()),
            'expiry' => Carbon::now()->addDays($duration),
        ];
    }
}
