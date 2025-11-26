<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'order_number', 'status', 'delivery_date',
        'total_price', 'payment_method', 'special_notes',
    ];

    /**
     * العلاقة مع المستخدم صاحب الطلب.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * العلاقة مع أصناف الطلب.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * العلاقة مع التقييم (قد يكون هناك تقييم واحد لكل طلب).
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
