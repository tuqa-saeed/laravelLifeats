<?php
// app/Models/MealCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    public function meals()
    {
        return $this->hasMany(Meal::class, 'category_id');
    }
}
