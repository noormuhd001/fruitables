<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class order extends Model
{
    use HasFactory;


    protected $fillable = [
        'first_name', 'last_name', 'address', 'city', 'country', 'postcode', 'mobile',
        'email', 'order_notes', 'user_id', 'total_amount', 'payment_method', 'paid_at', 'slug'
    ];

    // Generating a slug before saving the order
    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->slug = Str::slug($order->first_name . ' ' . $order->last_name . ' ' . now());
        });
    }
}
