<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'delivery_date',
        'total_price',
        'payment_method',
        'special_notes',
        'bakery_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bakery()
    {
        return $this->belongsTo(Bakery::class);
    }


    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
