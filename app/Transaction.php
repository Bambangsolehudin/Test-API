<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'uuid','name', 'email', 'number', 'address', 'transaction_total', 'transaction_status'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transactions_id');
    }
    
}
