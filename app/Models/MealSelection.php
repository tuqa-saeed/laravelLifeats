<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealSelection extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_schedule_id',
        'category_id',
        'meal_id',
    ];

    // Relationships
    public function mealSchedule()
    {
        return $this->belongsTo(MealSchedule::class);
    }

    public function category()
    {
        return $this->belongsTo(MealCategory::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
