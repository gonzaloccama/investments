<?php

namespace App\Http\Livewire\Admin;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlanComponent extends BaseAdmin
{
    public $name;
    public $percent;
    public $status;
    public $time_id;

    public $headers = [
        'id' => '#',
        'name' => 'Nombre',
        'percent' => 'Porcentaje',
        'status' => 'Estado',
        'plan_time' => 'Retorno',

        'not' => '',
    ];

    protected $attributes = [
        'name' => '<b><ins>Nombre</ins></b>',
        'percent' => '<b><ins>Porcentaje</ins></b>',
        'status' => '<b><ins>Estado</ins></b>',
        'time_id' => '<b><ins>Retorno</ins></b>',
    ];
    protected $rules = [
        'name' => 'required|min:3',
        'percent' => 'required|numeric',
        'status' => 'nullable',
        'time_id' => 'required',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'created_at';
        $this->sort = 'desc';

        $this->frame = 'index';

        $this->status = true;
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'plan_time']);
        $findIn = [];
        $table = 'plans';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

//        $findIn[] = 'times.name';

        $data['results'] = Plan::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->select($table . '.*')
            ->selectRaw('times.name as plan_time')
            ->join('times', 'times.id', '=', $table . '.time_id')
            ->paginate($this->limit);

        $data['_title'] = 'Planes';

        $this->emit('refreshContent');

        return view('livewire.admin.plan-component', $data)->layout('layouts.admin');
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

        $data = new Plan();

        $data->name = $this->name;
        $data->percent = $this->percent;
        $data->status = $this->status;
        $data->time_id = $this->time_id;

//        dd($data);
        if ($data->save()) {
            $this->emit('notification', ['Se creó nuevo plan exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $data = Plan::find($this->itemId);

        $this->name = $data->name;
        $this->percent = $data->percent;
        $this->status = $data->status;
        $this->time_id = $data->time_id;

        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $data = Plan::find($this->itemId);

            $data->name = $this->name;
            $data->percent = $this->percent;
            $data->status = $this->status;
            $data->time_id = $this->time_id;

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
        $this->percent = null;
        $this->status = true;
        $this->time_id = null;

        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Plan::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
