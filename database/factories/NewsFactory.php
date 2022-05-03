<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{News, Category, User};
use Faker\Factory as Faker;

class NewsFactory extends Factory
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
            'title' => $faker->sentence(),
            'user_id' => rand(1, User::count()),
            'reads' => $faker->numberBetween(103, 765),
            'published' => $faker->boolean(40), //40% chance of get true
            'category' => '',
            'description' => $faker->paragraph(25),
            'reference' => \Str::uuid(),
        ];
    }
}
