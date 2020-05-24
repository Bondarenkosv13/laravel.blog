<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
      'id',
      'name'
    ];

    public function Users()
    {
        return $this->hasMany(\App\Models\User::class);
    }
}
