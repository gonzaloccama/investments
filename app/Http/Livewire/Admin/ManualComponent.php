<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ManualComponent extends BaseAdmin
{
    public function mount()
    {
        $this->frame = 'index';
    }

    public function render()
    {
        $data['_title'] = 'Manual de usuario';

        return view('livewire.admin.manual-component', $data)->layout('layouts.admin');
    }
}
