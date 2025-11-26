<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['bakery_id', 'name', 'price', 'description', 'image_url'];

    /**
     * العلاقة مع المخبز الذي ينتمي إليه المنتج.
     */
    public function bakery()
    {
        return $this->belongsTo(Bakery::class);
    }
    
    /**
     * العلاقة مع تقييمات المنتج.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

