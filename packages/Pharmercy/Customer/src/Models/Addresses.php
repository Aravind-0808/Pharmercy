<?php

namespace Pharmercy\Customer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Addresses extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'alt_phone',
        'door_no',
        'street',
        'city',
        'district',
        'state',
        'country',
        'zip',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}