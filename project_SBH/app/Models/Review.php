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

<<<<<<< HEAD
   
=======
    /**
     * العلاقة مع المستخدم الذي قام بالتقييم.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function user()
    {
        return $this->belongsTo(User::class);
    }

<<<<<<< HEAD
    
=======
    /**
     * العلاقة مع الطلب الذي تم تقييمه.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
