<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technique;
use App\Models\Gear;

class TechniqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(GearSeeder::class);

        $gear1 = Gear::find(1);
        $gear2 = Gear::find(2);
        $gear3 = Gear::find(3);

        $techniques = [
            [
                'name' => 'Heel Hook',
                'description' => 'Using your heel to hook onto a hold.',
                'difficulty_level' => 'intermediate',
                'image' => 'heel_hook.jpg',
                'steps_to_practice' => '1. Place your heel on the hold. 2. Push down to stabilize. 3. Engage your core for balance.',
                'gear' => [$gear1->id, $gear2->id],
            ],
            [
                'name' => 'Crimp',
                'description' => 'Gripping small holds with your fingertips.',
                'difficulty_level' => 'advanced',
                'image' => 'crimp.jpg',
                'steps_to_practice' => '1. Position your fingertips on the edge. 2. Keep your thumb folded over your index finger. 3. Pull carefully to avoid injury.',
                'gear' => [$gear1->id],
            ],
            [
                'name' => 'Mantle',
                'description' => 'Pressing onto a hold to stabilize.',
                'difficulty_level' => 'intermediate',
                'image' => 'mantle.jpg',
                'steps_to_practice' => '1. Push your palm onto the hold. 2. Use your legs to propel upwards. 3. Shift your weight over the hold.',
                'gear' => [$gear3->id]
            ],
        ];

        foreach ($techniques as $techniqueData) {
            $technique = Technique::create([
                'name' => $techniqueData['name'],
                'description' => $techniqueData['description'],
                'difficulty_level' => $techniqueData['difficulty_level'],
                'image' => $techniqueData['image'],
                'steps_to_practice' => $techniqueData['steps_to_practice'],
            ]);

            $technique->gear()->attach($techniqueData['gear']);
        }
    }
}
