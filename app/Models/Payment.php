<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_subscription_id',
        'amount',
        'method',
        'payment_status',
        'paid_at',
    ];

    // Relationships
    public function userSubscription()
    {
        return $this->belongsTo(\App\Models\UserSubscription::class);
    }
}
