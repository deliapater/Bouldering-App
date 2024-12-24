<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gear;

class GearSeeder extends Seeder
{
    public function run()
    {
        Gear::create([
            'name' => 'Climbing Shoes',
            'category' => 'shoes',
            'description' => 'Specialized shoes for climbing.',
        ]);

        Gear::create([
            'name' => 'Chalk Bag',
            'category' => 'chalk',
            'description' => 'Holds chalk to keep hands dry.',
        ]);

        Gear::create([
            'name' => 'Harness',
            'category' => 'harness',
            'description' => 'Safety equipment for climbing.',
        ]);
    }
}
