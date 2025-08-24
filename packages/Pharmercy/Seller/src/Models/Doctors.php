<?php

namespace Pharmercy\Seller\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    use HasFactory;

    protected $table = 'doctors_list';
    protected $fillable = [
        'name',
        'logo',
        'address',
        'country',
        'state',
        'city',
        'zip_code',
        'specialization',
        'phone',
        'whatsapp',
        'is_active',
        'is_verified',
    ];
}