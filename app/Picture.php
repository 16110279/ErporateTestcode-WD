<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table = 'picture';
    protected $fillable =
    [
        'picture_name',
        'product_id'
    ];

    public function product()
    {
        return $this->hasMany('App\Product', 'product_id');
    }

    //
}
