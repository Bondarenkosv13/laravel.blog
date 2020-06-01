<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =[
        'id',
        'user_id',
        'user_name',
        'user_surname',
        'user_email',
        'user_phone',
        'country',
        'city',
        'address',
        'total',
        'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\OrdersStatus::class);
    }

    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }
}
