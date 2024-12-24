<?php

namespace Database\Factories;

use App\Models\Gear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gear>
 */
class GearFactory extends Factory
{
    protected $model = Gear::class;
  
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
