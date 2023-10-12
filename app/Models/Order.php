<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoiced',
        'package_id',
        'description',
        'status',
        'user_id',
        'price',
        'created_by',
        'total_price',
        'base_price',
        'renewal_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function partners()
    {
        return $this->hasMany(Partner::class);
    }

    public function package() {
        return $this->belongsTo(SubPackage::class);
    }

    public function files() {
        return $this->hasMany(File::class);
    }

    public function service() {
        return $this->hasOne(Service::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
}
