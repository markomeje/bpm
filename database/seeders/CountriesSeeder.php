<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{Country, State, City};
use Storage;
   
class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('/json/globe.json');
        $countries = json_decode(file_get_contents($path)); 

        foreach ($countries as $country) {
            Country::create([
                'currency' => $country->currency,
                'iso2' => $country->iso2, 
                'capital' => $country->capital, 
                'iso3' => $country->iso3, 
                'name' => $country->name, 
                'phonecode' => $country->phone_code, 
                'region' => $country->region, 
            ]);  
        }
    }
}