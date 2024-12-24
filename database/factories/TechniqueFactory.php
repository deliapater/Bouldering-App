<?php

namespace Database\Factories;

use App\Models\Technique;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\DifficultyLevel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gear>
 */
class TechniqueFactory extends Factory
{
    protected $model = Technique::class;
  
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'difficulty_level' => $this->faker->randomElement([
                DifficultyLevel::BEGINNER->value,
                DifficultyLevel::INTERMEDIATE->value,
                DifficultyLevel::ADVANCED->value,
            ]),
            'image' => $this->faker->imageUrl(640, 480, 'techniqye', true, 'Bouldering Technique'),
            'steps_to_practice' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
