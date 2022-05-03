<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::truncate();
        $skills = [
			'Air Condition Repairs',
			'Aluminium Works',
			'Architects',
			'Are Dealer and Artist',
			'Blacksmith',
			'Block and Cement Dealer',
			'Borehole Installation',
			'Brick Layer',
			'Building Construction',
			'Building Material Sales',
			'Car Hire Services',
			'Car Wash',
			'Carpenter',
			'Carpenter and Furniture Maker',
			'CCTV Installation',
			'Cleaning and fumigation',
			'Cleaning Equipment Sales',
			'Computer Engineer',
			'Computer Graphics',
			'Concrete Caster',
			'Craftwork',
			'Decorator',
			'Design and print works',
			'DSTV installation and maintenance',
			'Electronic Sales',
			'Electric fence and wire fencing',
			'Electric Material',
			'Electricians and Electronic Repairer',
			'Electronics Repair',
			'Engineering  Services',
			'Fabricator',
			'Farmer',
			'Tailor and Fashion Designing',
			'Forklift Mechanic',
			'Refrigerator Repairer',
			'Furniture makers',
			'Gas cooker Maintenance',
			'Gas Sales Distribution and Installation',
			'Gas wares',
			'Generator Mechanic',
			'Graphic Designer',
			'Home Delivery Services',
			'Home movers',
			'Horticulture and Florist',
			'Household Equipment  Sales',
			'Interior Decor',
			'Interlocking Stone Production fixing',
			'Inverter Sales and Maintenance',
			'Key Cutter',
			'Landscape Contractor',
			'Laundry and Dry Cleaning Services',
			'Marble and granite Sales',
			'Pop and Scrading',
			'Mason',
			'Painter',
			'Pest Control and Fumigation Services',
			'Pet Sales',
			'Phone dealers',
			'Phone dealer and Repairs',
			'Plumbeing',
			'Pumping Machine installation and maintenance',
			'Real Estate agents',
			'Rental Services',
			'Roofing and roof repairs',
			'Rug wash',
			'Rug and Carpet',
			'Scaffolding',
			'Security Guard Agency',
			'Steel works',
			'Swimming pool Construction',
			'Technician',
			'Tiler',
			'Trader',
			'Truck Hire Services',
			'Water Pumping Machine Installation',
			'Water Sales and distribution',
			'Water treatment',
			'Welder',
			'Window blinds',
			'Solar Power Equipment Sales',
			'2d-3d design',
			'Solar Equipment installation',
		];

        foreach ($skills as $skill) {
            Skill::create(['name' => $skill]);
        }
    }
}
