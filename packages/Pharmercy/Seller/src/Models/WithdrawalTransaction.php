<?php

namespace Pharmercy\Seller\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalTransaction extends Model
{
    use HasFactory;


    protected $table = 'wallet_withdrawal_transaction';
    protected $fillable = [
        'store_id',
        'bank_details_id',
        'amount',
        'created_at',
        'updated_at'
    ];

}