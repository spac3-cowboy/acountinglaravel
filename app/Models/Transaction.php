<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    public function account()
    {
       return $this->belongsTo(TransactionAccount::class, 'transaction_account_id', 'id');
    }

    public function transactionHead()
    {
       return $this->belongsTo(TransactionHead::class, 'transaction_head_id', 'id');
    }


}
