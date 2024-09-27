<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'booking_date',
        'status',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the DiscountUsage model
    public function discountUsages()
    {
        return $this->hasMany(DiscountUsage::class);
    }
}
