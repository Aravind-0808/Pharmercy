<?php

namespace Pharmercy\Customer\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionLog extends Model
{
    protected $fillable = [
        'transaction_id',
        'event',
        'details',
        'logged_at',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
