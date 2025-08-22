<?php

namespace Pharmercy\Seller\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pharmercy\Customer\Models\Transaction;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallet_transaction';
    protected $fillable = [
        'store_id',
        'transaction_id',
        'amount',
        'type',
        'description'
    ];

    public function store()
    {
        return $this->belongsTo(Stores::class);
    }
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public static function getBalance($store_id)
    {
        return self::where('store_id', $store_id)
            ->selectRaw("
                SUM(CASE WHEN type = 'credit' THEN amount ELSE 0 END) -
                SUM(CASE WHEN type = 'debit' THEN amount ELSE 0 END) as balance
            ")
            ->value('balance') ?? 0;
    }
}
