<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class DailyReport extends Model
{
    use HasFactory;

    public static function next()
    {
        return static::max('increase') + 1;
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function getOfficeNameAttribute()
    {
        return $this->office ? $this->office->office : 'General';
    }

}
