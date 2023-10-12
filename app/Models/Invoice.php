<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'status',
        'description',
        'company_id',
        'order_id',
        'service_id',
        'price',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
