<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class orderitem extends Model
{
    use HasFactory;


    public static function boot()
    {
        parent::boot();

        static::creating(function ($orderitem) {
            $orderitem->slug = str::slug($orderitem->name . ' '. now());
        });
    }
}
