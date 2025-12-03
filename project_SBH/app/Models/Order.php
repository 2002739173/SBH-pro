<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
<<<<<<< HEAD
        'user_id',
        'order_number',
        'status',
        'delivery_date',
        'total_price',
        'payment_method',
        'special_notes',
        'bakery_id',
    ];


=======
        'user_id', 'order_number', 'status', 'delivery_date',
        'total_price', 'payment_method', 'special_notes',
    ];

    /**
     * العلاقة مع المستخدم صاحب الطلب.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function user()
    {
        return $this->belongsTo(User::class);
    }

<<<<<<< HEAD
    public function bakery()
    {
        return $this->belongsTo(Bakery::class);
    }


=======
    /**
     * العلاقة مع أصناف الطلب.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

<<<<<<< HEAD

=======
    /**
     * العلاقة مع التقييم (قد يكون هناك تقييم واحد لكل طلب).
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
