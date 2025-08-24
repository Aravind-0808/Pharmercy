<?php

namespace Pharmercy\Seller\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labs extends Model
{
    use HasFactory;

    protected $table = 'labs_list';
    protected $fillable = [
        'name',
        'logo',
        'address',
        'country',
        'state',
        'city',
        'zip_code',
        'lab_type',
        'phone',
        'whatsapp',
        'is_active',
        'is_verified',
    ];
}
