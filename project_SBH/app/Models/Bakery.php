<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bakery extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'city', 'latitude', 'longitude', 'description', 'image_url', 'rating_average'];

    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
