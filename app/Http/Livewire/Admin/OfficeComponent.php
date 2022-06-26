<?php

namespace App\Http\Livewire\Admin;

use App\Models\Office;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Str;

class OfficeComponent extends BaseAdmin
{
    public $prefix;
    public $office;
    public $address;
    public $type;
    public $responsible;

    public $headers = [
        'id' => '#',
        'prefix' => 'Prefijo',
        'office' => 'Oficina',
        'address' => 'Dirección',
        'type' => 'Rango',
        'fullname' => 'Responsable',

        'not' => '',
    ];

    protected $attributes = [
        'prefix' => '<b><ins>Prefijo</ins></b>',
        'office' => '<b><ins>Oficina</ins></b>',
        'address' => '<b><ins>Dirección</ins></b>',
        'type' => '<b><ins>Rango</ins></b>',
        'responsible' => '<b><ins>Responsable</ins></b>',
    ];
    protected $rules = [
        'prefix' => 'required|size:2|unique:offices',
        'office' => 'required|min:3',
        'address' => 'required|min:3',
        'type' => 'required',
        'responsible' => 'nullable',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'id';
        $this->sort = 'asc';

        $this->frame = 'index';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname']);
        $findIn = [];
        $table = 'offices';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }
//        DB::enableQueryLog();
        $data['results'] = Office::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'LIKE', '%' . $this->keyWord . '%');
            })
            ->select($table . '.*')
            ->leftJoin('users', 'users.id', '=', $table . '.responsible')
            ->selectRaw('CONCAT(users.firstname," ",users.lastname)  as fullname')
            ->paginate($this->limit);
//        dd(DB::getQueryLog());
        $data['_title'] = 'Oficinas';

        $this->emit('refreshContent');

        return view('livewire.admin.office-component', $data)->layout('layouts.admin');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function generatePrefix()
    {
        if ($this->office) {
            $this->prefix = mb_convert_case(
                Str::slug(Str::limit($this->office, 2, ''), ''),
                MB_CASE_UPPER, 'UTF-8'
            );
        }
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

        $data = new Office();

        $data->prefix = $this->prefix;
        $data->office = $this->office;
        $data->address = $this->address;
        $data->type = $this->type;
        $data->responsible = $this->responsible;

        if ($data->save()) {
            $this->emit('notification', ['Se creó nueva Oficina exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $data = Office::find($this->itemId);

        $this->prefix = $data->prefix;
        $this->office = $data->office;
        $this->address = $data->address;
        $this->type = $data->type;
        $this->responsible = $data->responsible;

        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {
            $rules = $this->rules;
            unset($rules['prefix']);
            $this->validate($rules, [], $this->attributes);

            $data = Office::find($this->itemId);

            $data->office = $this->office;
            $data->address = $this->address;
            $data->type = $this->type;
            $data->responsible = $this->responsible;

            if ($data->save()) {
                $this->emit('notification', ['Oficina se ha actualizado exitosamente']);
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

        $this->prefix = null;
        $this->office = null;
        $this->address = null;
        $this->type = null;
        $this->responsible = null;

        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Office::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
