<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersStatus extends Model
{
    protected $table = 'orders_statuses';

    protected $fillable = ['id', 'type'];

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }
}
