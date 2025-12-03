<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_name',
        'bread_type',
        'bread_size',
        'quantity',
        'price',
        'product_id',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {

        return $this->belongsTo(Product::class);
    }
}
