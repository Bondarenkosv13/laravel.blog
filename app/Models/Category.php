<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    public function image()
    {
        return $this->morphOne(\App\Models\Image::class, 'imageable');
    }

    public function getShortDescriptionAttribute()
    {
        $more = strlen($this->description) > 100 ? '...' : '';
        return substr($this->description, 0, 100) . $more ;
    }
}
