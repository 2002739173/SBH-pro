<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['bakery_id', 'name', 'price', 'description', 'image_url'];

<<<<<<< HEAD
    
=======
    /**
     * العلاقة مع المخبز الذي ينتمي إليه المنتج.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function bakery()
    {
        return $this->belongsTo(Bakery::class);
    }
    
<<<<<<< HEAD
    
=======
    /**
     * العلاقة مع تقييمات المنتج.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

