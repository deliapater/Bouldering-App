<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        Location::insert([
            [
                'name' => 'Central Park',
                'latitude' => 40.785091,
                'longitude' => -73.968285,
                'description' => 'New York, NY 10024, USA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Boulder Rock Gym',
                'latitude' => 39.987654,
                'longitude' => -105.123456,
                'description' => '123 Boulder St, Boulder, CO 80301',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Cliffs at Long Island City',
                'latitude' => 40.744682,
                'longitude' => -73.952472,
                'description' => '11-11 44th Dr, Long Island City, NY 11101',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}