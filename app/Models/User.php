<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Cashier\Billable; // ✅ Add this

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Billable; // ✅ Add Billable here

    protected $fillable = [
        'name',
        'email',
        'phone', 
        'address', 
        'role', 
        'preferences',
        'allergies',
        'password',
        // ✅ Stripe fields for Cashier
        'stripe_id',
        'pm_type',
        'pm_last_four',
        'trial_ends_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
