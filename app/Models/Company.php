<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'name',
        'activities',
        'addons',
        'order_id',
        'total_shares',
        'share_price',
        'company_creator_share_holds'
    ];

    public function partners() {
        return $this->hasMany(Partner::class);
    }
}
