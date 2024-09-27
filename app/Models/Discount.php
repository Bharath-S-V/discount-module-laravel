<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'description',
        'discount_type',
        'value',
        'valid_from',
        'valid_to',
        'recurring',
        'family_member_discount',
        'max_usage'
    ];

    public function usages()
    {
        return $this->hasMany(DiscountUsage::class);
    }
}
