<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'id',
        'path',
        'imageable_id',
        'imageable_type'
    ];

    protected $hidden = [
        'imageable_id',
        'imageable_type'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->morphMany(\App\Models\Product::class, 'imageable');
    }
}
