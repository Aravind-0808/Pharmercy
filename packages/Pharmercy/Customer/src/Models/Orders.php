<?php

namespace Pharmercy\Customer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Pharmercy\Seller\Models\Products;
use Pharmercy\Seller\Models\Stores;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'store_id',
        'product_id',
        'quantity',
        'address_id',
        'total_amount',
        'payment_type',
        'ordered_at',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function store()
    {
        return $this->belongsTo(Stores::class);
    }

    public function address()
    {
        return $this->belongsTo(Addresses::class);
    }
}