<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountUsage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'product_id',
        'discount_id',
        'usage_date',
    ];

    // Define the relationship with the Discount model
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Booking model
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
