<?php

namespace Database\Seeders;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::truncate();
        $currencies = [
            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$'],
            ['name' => 'British Pound', 'code' => 'GBP', 'symbol' => '£'],
            ['name' => 'Canadian Dollar', 'code' => 'CAD', 'symbol' => '$'],
            ['name' => 'Australian Dollar', 'code' => 'AUD', 'symbol' => '$'],
            ['name' => 'Euro', 'code' => 'EUR', 'symbol' => '€'],
            ['name' => 'New Zealand Dollar', 'code' => 'NZD', 'symbol' => '$'],
            ['name' => 'Swiss Franc', 'code' => 'CHF', 'symbol' => 'CHf'],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥'],
            ['name' => 'Nigerian Naira', 'code' => 'NGN', 'symbol' => '₦'],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
