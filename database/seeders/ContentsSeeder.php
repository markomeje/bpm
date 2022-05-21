<?php

namespace Database\Seeders;
use App\Models\{Content, Staff};
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Hash;

class ContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            ['content' => 'World Best Property Market is a global real estate property listing, search, and match engine company leveraging new innovative technologies. We are strategically positioned to solve multiple property transaction problems in the global real estate market. With a team of smart, innovative, and talented professionals, our goal is to connect individuals, organizations, developers, brokerage, property management, professional and non-professional service providers to the worldwide property industry.', 'page' => 'about', 'section' => 1, 'user_id' => auth()->id(), 'title' => 'About Us', 'status' => 'active'],
            ['content' => 'Our Mission is to make Real Estate transactions hurdle free, transparent, easy, and secure. Real Estate transactions, over time, have been tarnished by frustration associated with the listing, buying, selling, and renting as much as ease the transition between reaching experienced skilled men, quality construction equipment, and materials. <br/><br/>With a smart combination of data analytics, experienced professionals, and 25 years of experience in this industry, our services provide the most seamless approach to all transactions in the global market.', 'page' => 'about', 'section' => 2, 'user_id' => auth()->id(), 'title' => 'Our Mission', 'status' => 'active'],
            ['content' => 'Integrity;Quality and Excellence Service delivery;Customer Satisfaction;Innovative;Sustainability;Trust;', 'page' => 'about', 'section' => 3, 'user_id' => auth()->id(), 'title' => 'Core Values', 'status' => 'active'],
        ];

        Content::truncate();
        foreach ($contents as $content) {
            Content::create($content);
        }

    }
}
