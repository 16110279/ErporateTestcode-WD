<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = 'transaction';

    protected $fillable = [
        'user_id',
        'transaction_code',
        'transaction_status',
        'transaction_total'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function transactionItem()
    {
        return $this->hasMany('App\TransactionItem', 'transaction_id');
    }
}
