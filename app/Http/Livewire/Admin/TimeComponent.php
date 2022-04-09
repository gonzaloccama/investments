<?php

namespace App\Http\Livewire\Admin;

use App\Models\Time;
use Illuminate\Database\Eloquent\Model;

class TimeComponent extends BaseAdmin
{
    public $name;
    public $duration;

    public $headers = [
        'id' => '#',
        'name' => 'Nombre',
        'duration' => 'Duración (días)',

        'not' => '',
    ];

    protected $attributes = [
        'name' => '<b><ins>Nombre</ins></b>',
        'duration' => '<b><ins>Duración (Días)</ins></b>',
    ];
    protected $rules = [
        'name' => 'required|min:3',
        'duration' => 'required|numeric',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'created_at';
        $this->sort = 'desc';

        $this->frame = 'index';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not']);
        $findIn = [];
        $table = 'times';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Time::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Tiempos';

        $this->emit('refreshContent');

        return view('livewire.admin.time-component', $data)->layout('layouts.admin');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    // BEGIN DYNAMIC METHODS

    public function openFrame()
    {
        $this->frame = 'add';
        $this->emit('refreshSection');
    }

    public function saveData()
    {
        $this->validate($this->rules, [], $this->attributes);

        $data = new Time();

        $data->name = $this->name;
        $data->duration = $this->duration;

        if ($data->save()) {
            $this->emit('notification', ['Se creó nuevo plan exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $data = Time::find($this->itemId);

        $this->name = $data->name;
        $this->duration = $data->duration;

        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $data = Time::find($this->itemId);

            $data->name = $this->name;
            $data->duration = $this->duration;

            if ($data->save()) {
                $this->emit('notification', ['Plan actualizado exitosamente']);
                $this->closeFrame();
            }
        }
    }

    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();
    }

    public function cleanItems()
    {
        $this->itemId = null;
        $this->deleteId = null;

        $this->name = null;
        $this->duration = null;

        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Time::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
