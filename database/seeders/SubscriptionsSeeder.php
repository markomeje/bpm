<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Subscription, Profile};

class SubscriptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::truncate();
        // Subscription::factory()->count(Profile::count())->create();
    }
}
