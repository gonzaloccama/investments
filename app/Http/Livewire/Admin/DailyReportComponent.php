<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class DailyReportComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.daily-report-component')->layout('layouts.admin');
    }
}
