<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class DashboardComponent extends BaseAdmin
{
    public function mount()
    {
        $this->frame = 'index';
    }

    public function render()
    {
        $data['_title'] = 'Dashboard';
        return view('livewire.admin.dashboard-component', $data)->layout('layouts.admin');
    }
}
