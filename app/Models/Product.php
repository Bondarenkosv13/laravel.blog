<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[
        'id',
        'category_id',
        'sku',
        'name',
        'description',
        'short_description',
        'price',
        'discount',
        'quantity',
        'thumbnail'
    ];

    public function categories()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(\App\Models\Order::class)->withPivot('quantity', 'price');
    }

    public function image()
    {
        return $this->morphMany(\App\Models\Image::class, 'imageable');
    }
}
