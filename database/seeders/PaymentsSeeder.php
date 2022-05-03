<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();
        Payment::factory()->count(401)->create();
    }
}
