<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technique extends Models{

    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'difficulty_level',
        'image',
        'steps_to_practice'
    ];

    public function gear()
    {
        return $this->belongsToMany(Gear::class, 'techniques_gears');
    }
}