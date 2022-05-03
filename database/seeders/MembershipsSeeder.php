<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Membership::truncate();
        $memberships = [
            ['name' => 'Daily', 'price' => 3000, 'paidlisting' => 12, 'freelisting' => 6, 'freeboost' => 6, 'status' => 'active', 'duration' => 1],
            ['name' => 'Weekly', 'price' => 8500, 'paidlisting' => 95, 'freelisting' => 27, 'freeboost' => 18, 'status' => 'active', 'duration' => 7],
            ['name' => 'Monthly', 'price' => 31500, 'paidlisting' => 480, 'freelisting' => 120, 'freeboost' => 90, 'status' => 'active', 'duration' => 30],
            ['name' => 'Quaterly', 'price' => 85000, 'paidlisting' => 1600, 'freelisting' => 160, 'freeboost' => 120, 'status' => 'active', 'duration' => 120],
            ['name' => 'Yearly', 'price' => 300000, 'paidlisting' => 2000, 'freelisting' => 200, 'freeboost' => 180, 'status' => 'active', 'duration' => 360],
        ];

        foreach ($memberships as $plan) {
            Membership::create($plan);
        }
    }
}
