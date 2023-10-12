<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'description',
        'company_id',
        'auto_renewal',
        'order_id',
        'end_date',
        'stripe_subscription_id',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
