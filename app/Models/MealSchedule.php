<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MealSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_subscription_id',
        'date',
        'locked',
    ];

    // Relationships
    public function userSubscription()
    {
        return $this->belongsTo(\App\Models\UserSubscription::class);
    }


    public function selections()
    {
        return $this->hasMany(MealSelection::class);
    }
}
