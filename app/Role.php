<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
        'role_name', 'created_at', 'updated_at'
    ];
}
