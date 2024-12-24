<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\DifficultyLevel;

class Technique extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'difficulty_level',
        'image',
        'steps_to_practice'
    ];

    protected $casts = [
        'difficulty_level' => DifficultyLevel::class
    ];

    public function gear()
    {
        return $this->belongsToMany(Gear::class, 'techniques_gears');
    }
}