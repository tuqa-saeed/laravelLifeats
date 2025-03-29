<?php
// app/Models/Meal.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'calories',
        'protein',
        'carbs',
        'fats',
        'image_url',
        'category_id',
        'subscription_id'
    ];

    public function category()
    {
        return $this->belongsTo(MealCategory::class, 'category_id');
    }
    public function subscriptions()
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
}
