<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    //

    protected $table = 'transaction_item';


    protected $fillable = [
        'transaction_id',
        'product_id',
        'item_qty',
        // 'item_price',
        'item_subtotal'
    ];


    public function transaction()
    {
        return $this->belongsTo('App\Transaction', 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }

    public function picture()
    {
        return $this->belongsTo('App\Picture', 'product_id');
    }
}
