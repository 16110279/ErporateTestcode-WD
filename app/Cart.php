<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table = 'cart';
    protected $filable =
    [
        'cart_qty',
        'subtotal',
        'product_id',
        'user_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function picture()
    {
        return $this->belongsTo('App\Picture', 'product_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}