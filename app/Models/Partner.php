<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'nationality',
        'country',
        'city',
        'address',
        'whatsapp_number',
        'dob',
        'share_holds',
        'passport',
        'company_id',
        'order_id',
    ];
}
