<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
<<<<<<< HEAD
        'order_id',
        'product_name',
        'bread_type',
        'bread_size',
        'quantity',
        'price',
        'product_id',
    ];


=======
        'order_id', 'product_name', 'bread_type', 'bread_size', 'quantity', 'price',
    ];

    /**
     * العلاقة مع الطلب.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
<<<<<<< HEAD

    public function product()
    {

        return $this->belongsTo(Product::class);
    }
=======
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
}
