<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'product';
    protected $fillable = [
        'category_id',
        'status',
        'product_name',
        'product_price'
    ];


    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function picture()
    {
        return $this->hasMany('App\Picture'::class);
    }

    public function transactionItem()
    {
        return $this->hasMany('App\TransactionItem', 'product_id');
    }

    public function cart()
    {
        return $this->hasMany('App\Cart', 'product_id');
    }
}
