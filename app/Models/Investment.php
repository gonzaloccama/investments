<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function isCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }

    public function isPlan()
    {
        return $this->belongsTo(Plan::class, 'plan');
    }

    public function cashDeposit()
    {
        return $this->hasMany(CashDeposit::class);
    }

    public function bankTransfer()
    {
        return $this->hasMany(BankTransfer::class);
    }

    public function inPayment()
    {
        return $this->hasMany(Payment::class);
    }

//    public function getRemainingDaysAttribute()
//    {
//        if ($this->end_date) {
//            $remaining_days = Carbon::now()->diffInDays(Carbon::parse($this->end_date));
//        } else {
//            $remaining_days = 0;
//        }
//        return $remaining_days;
//    }
//
//    public function getBeetweenDaysAttribute()
//    {
//        if ($this->end_date) {
//            $remaining_days = Carbon::create($this->start_date)->diffInDays(Carbon::parse($this->end_date));
//        } else {
//            $remaining_days = 0;
//        }
//        return $remaining_days;
//    }

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
