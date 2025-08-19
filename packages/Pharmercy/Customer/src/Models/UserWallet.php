<?php

namespace Pharmercy\Customer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserWallet extends Model
{
    use HasFactory;

    protected $table = 'user_wallet';
    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
        'type',
    ];

    public static function getWalletBalance($user_id)
    {

        return self::where('user_id', $user_id)
            ->selectRaw("
                SUM(CASE WHEN type = 'credit' THEN amount ELSE 0 END) -
                SUM(CASE WHEN type = 'debit' THEN amount ELSE 0 END) as balance
            ")
            ->value('balance') ?? 0;
    }
}