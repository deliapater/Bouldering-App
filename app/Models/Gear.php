<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gear extends Model
{
    use CrudTrait;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category'
    ];

    public function techniques()
    {
        return $this->belongsToMany(Technique::class, 'techniques_gears');
    }
}