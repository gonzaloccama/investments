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

    public function getRemainingDaysAttribute()
    {
        if ($this->end_date) {
            $remaining_days = Carbon::now()->diffInDays(Carbon::parse($this->end_date));
        } else {
            $remaining_days = 0;
        }
        return $remaining_days;
    }

    public function getBeetweenDaysAttribute()
    {
        if ($this->end_date) {
            $remaining_days = Carbon::create($this->start_date)->diffInDays(Carbon::parse($this->end_date));
        } else {
            $remaining_days = 0;
        }
        return $remaining_days;
    }

    public function getPercentAttribute()
    {
        if ($this->end_date && $this->start_date) {
            $percent = round(($this->beetween_days - $this->remaining_days) * 100 / $this->beetween_days, 2);
        } else {
            $percent = 0;
        }
        return $percent;
    }
}
