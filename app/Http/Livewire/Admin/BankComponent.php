<?php

namespace App\Http\Livewire\Admin;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Validator;

class BankComponent extends BaseAdmin
{
public $name;
public $url;
public $ruc;
public $address;

    public $headers = [
        'id' => '#',
        'name' => 'Nombre',
        'url' => 'URL',
        'ruc' => 'RUC',
        'address' => 'Dirección',

        'not' => '',
    ];

    protected $attributes = [
        'name' => '<b><ins>Nombre</ins></b>',
        'url' => '<b><ins>URL</ins></b>',
        'ruc' => '<b><ins>RUC</ins></b>',
        'address' => '<b><ins>Dirección</ins></b>',
    ];
    protected $rules = [
        'name' => 'required|min:3',
        'url' => 'required|url',
        'ruc' => 'required|numeric|digits:11|first_character',
        'address' => 'required',
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
        $table = 'banks';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Bank::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Bancos';

        $this->emit('refreshContent');

        return view('livewire.admin.bank-component', $data)->layout('layouts.admin');
    }

    public function updated($property)
    {
        $this->customValidation();
        $this->validateOnly($property, $this->rules,
            ['ruc.first_character' => ':attribute debe ser 2 como primer número'],
            $this->attributes);
    }

    // BEGIN DYNAMIC METHODS

    public function openFrame()
    {
        $this->frame = 'add';
        $this->emit('refreshSection');
    }

    public function saveData()
    {
        $this->customValidation();

        $this->validate($this->rules,
            ['ruc.first_character' => ':attribute debe ser 2 como primer número'],
            $this->attributes);

        $data = new Bank();

        $data->name = $this->name;
        $data->url = $this->url;
        $data->ruc = $this->ruc;
        $data->address = $this->address;

        if ($data->save()) {
            $this->emit('notification', ['Se creó nuevo Banco exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $data = Bank::find($this->itemId);

        $this->name = $data->name;
        $this->url = $data->url;
        $this->ruc = $data->ruc;
        $this->address = $data->address;

        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->customValidation();

            $this->validate($this->rules, [], $this->attributes);

            $data = Bank::find($this->itemId);

            $data->name = $this->name;
            $data->url = $this->url;
            $data->ruc = $this->ruc;
            $data->address = $this->address;

            if ($data->save()) {
                $this->emit('notification', ['Banco actualizado exitosamente']);
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
        $this->url = null;
        $this->ruc = null;
        $this->address = null;

        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Bank::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }

    /*****/

    private function customValidation()
    {
        Validator::extend('first_character', function ($attr, $value) {
            return preg_match('/^[2].*/i', $value);
        });
    }
}
