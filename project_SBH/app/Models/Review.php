<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'order_id', 'rating', 'notes',
    ];

    /**
     * العلاقة مع المستخدم الذي قام بالتقييم.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * العلاقة مع الطلب الذي تم تقييمه.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
