<?php

namespace Pharmercy\Seller\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'logo',
        'address',
        'country',
        'state',
        'city',
        'zip_code',
        'is_active',
        'is_verified',
    ];

    public function products()
    {
        return $this->hasMany(products::class);
    }
}
