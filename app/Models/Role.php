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
        return $this->hasOne(\App\Models\User::class);
    }
}
