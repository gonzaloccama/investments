<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    public function isCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }

    public function getCodeAttribute()
    {
        return $this->investment->code;
    }

    public function getRemainingHoursAttribute()
    {
        if ($this->end_date >  Carbon::today()) {
            $remaining_hours = Carbon::now()->diffInHours(Carbon::parse($this->end_date));
        } else {
            $remaining_hours = 0;
        }
        return $remaining_hours;
    }

    public function getBeetweenHoursAttribute()
    {
        if ($this->end_date) {
            $beetween_hours = Carbon::create($this->start_date)->diffInHours(Carbon::parse($this->end_date));
        } else {
            $beetween_hours = 0;
        }
        return $beetween_hours;
    }

    public function getPercentAttribute()
    {
        if ($this->end_date && $this->start_date) {
            $percent = round(($this->beetween_hours - $this->remaining_hours) * 100 / $this->beetween_hours, 2);
        } else {
            $percent = 0;
        }
        return $percent;
    }
}
