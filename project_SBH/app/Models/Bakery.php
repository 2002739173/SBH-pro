<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bakery extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'city', 'latitude', 'longitude', 'description', 'image_url', 'rating_average'];

<<<<<<< HEAD
    
=======
    /**
     * العلاقة مع منتجات المخبز.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function products()
    {
        return $this->hasMany(Product::class);
    }

<<<<<<< HEAD
    
=======
    /**
     * العلاقة مع تقييمات المخبز.
     */
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
