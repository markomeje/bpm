<?php

namespace Database\Seeders;
use App\Models\{Package, Membership, Currency};
use Illuminate\Database\Seeder;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            'Business Package' => [
                ['name' => 'daily', 'duration' => 1, 'price' => 350, 'paidlisting' => 9, 'freelisting' => 0, 'freeboost' => 4],
                ['name' => 'weekly', 'duration' => 7, 'price' => 2400, 'paidlisting' => 12, 'freelisting' => 5, 'freeboost' => 3],
                ['name' => 'monthly', 'duration' => 30, 'price' => 8500, 'paidlisting' => 50, 'freelisting' => 20, 'freeboost' => 7],
                ['name' => 'quaterly', 'duration' => 90, 'price' => 23500, 'paidlisting' => 160, 'freelisting' => 35, 'freeboost' => 21],
                ['name' => 'yearly', 'duration' => 360, 'price' => 62500, 'paidlisting' => 650, 'freelisting' => 75, 'freeboost' => 30],
            ],

            'Premium Package' => [
                ['name' => 'daily', 'duration' => 1, 'price' => 1000, 'paidlisting' => 7, 'freelisting' => 3, 'freeboost' => 3],
                ['name' => 'weekly', 'duration' => 7, 'price' => 5500, 'paidlisting' => 38, 'freelisting' => 10, 'freeboost' => 7],
                ['name' => 'monthly', 'duration' => 30, 'price' => 17000, 'paidlisting' => 170, 'freelisting' => 50, 'freeboost' => 30],
                ['name' => 'quaterly', 'duration' => 90, 'price' => 43500, 'paidlisting' => 520, 'freelisting' => 65, 'freeboost' => 44],
                ['name' => 'yearly', 'duration' => 360, 'price' => 152000, 'paidlisting' => 2100, 'freelisting' => 80, 'freeboost' => 60],
            ],

            'Executive Package' => [
                ['name' => 'daily', 'duration' => 1, 'price' => 2000, 'paidlisting' => 10, 'freelisting' => 4, 'freeboost' => 4],
                ['name' => 'weekly', 'duration' => 7, 'price' => 7000, 'paidlisting' => 50, 'freelisting' => 15, 'freeboost' => 12],
                ['name' => 'monthly', 'duration' => 30, 'price' => 24000, 'paidlisting' => 320, 'freelisting' => 75, 'freeboost' => 45],
                ['name' => 'quaterly', 'duration' => 90, 'price' => 65000, 'paidlisting' => 1000, 'freelisting' => 90, 'freeboost' => 49],
                ['name' => 'yearly', 'duration' => 360, 'price' => 220000, 'paidlisting' => 12200, 'freelisting' => 120, 'freeboost' => 90],
            ],
            'V.I.P Package' => [
                ['name' => 'daily', 'duration' => 1, 'price' => 3000, 'paidlisting' => 12, 'freelisting' => 6, 'freeboost' => 6],
                ['name' => 'weekly', 'duration' => 7, 'price' => 8500, 'paidlisting' => 95, 'freelisting' => 27, 'freeboost' => 18],
                ['name' => 'monthly', 'duration' => 30, 'price' => 31500, 'paidlisting' => 480, 'freelisting' => 120, 'freeboost' => 90],
                ['name' => 'quaterly', 'duration' => 90, 'price' => 85000, 'paidlisting' => 1600, 'freelisting' => 160, 'freeboost' => 120],
                ['name' => 'yearly', 'duration' => 360, 'price' => 300000, 'paidlisting' => 2000, 'freelisting' => 200, 'freeboost' => 180],
            ]
        ];

        $currency = Currency::where(['code' => 'NGN'])->first();
        Package::truncate();
        foreach ($packages as $package => $memberships) {
            $package = Package::create([
                'name' => $package
            ]);

            if (!empty($package->id)) {
                $package_id = $package->id > Package::count() ? rand(1, 4) : $package->id;
                foreach ($memberships as $membership) {
                    Membership::create([
                        'name' => $membership['name'],
                        'duration' => $membership['duration'],
                        'price' => $membership['price'],
                        'freelisting' => $membership['freelisting'],
                        'paidlisting' => $membership['paidlisting'],
                        'freeboost' => $membership['freeboost'],
                        'package_id' => $package_id,
                        'currency_id' => $currency->id ?? null,
                        'status' => 'active'
                    ]);
                }
            }
        }
    }
}
