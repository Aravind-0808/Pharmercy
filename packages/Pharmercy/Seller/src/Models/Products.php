<?php

namespace Pharmercy\Seller\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'image',
        'description',
        'original_price',
        'selling_price',
        'discount',
        'stock',
        'is_active'
    ];

    public function store()
    {
        return $this->belongsTo(stores::class);
    }
}
