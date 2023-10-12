<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function setPathAttribute($files)
    {
        if (is_array($files)) {
            $this->attributes['path'] = json_encode($files);
        }
    }

    public function getPathAttribute($files)
    {
        return json_decode($files, true);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
