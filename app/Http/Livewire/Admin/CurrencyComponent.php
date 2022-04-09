<?php

namespace App\Http\Livewire\Admin;

use App\Models\Currency;

class CurrencyComponent extends BaseAdmin
{
    public $currency;
    public $symbol;
    public $code;

    public $headers = [
        'id' => '#',
        'currency' => 'Moneda',
        'symbol' => 'Simbolo',
        'code' => 'Código',

        'not' => '',
    ];

    protected $attributes = [
        'currency' => '<b><ins>Moneda</ins></b>',
        'symbol' => '<b><ins>Simbolo</ins></b>',
        'code' => '<b><ins>Código</ins></b>',
    ];
    protected $rules = [
        'currency' => 'required',
        'symbol' => 'required',
        'code' => 'required',
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
        $table = 'currencies';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Currency::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Monedas';

        $this->emit('refreshContent');

        return view('livewire.admin.currency-component', $data)->layout('layouts.admin');
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

        $data = new Currency();

        $data->currency = $this->currency;
        $data->symbol = $this->symbol;
        $data->code = $this->code;

        if ($data->save()) {
            $this->emit('notification', ['Se creó nueva moneda exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $data = Currency::find($this->itemId);

        $this->currency = $data->currency;
        $this->symbol = $data->symbol;
        $this->code = $data->code;

        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $data = Currency::find($this->itemId);

            $data->currency = $this->currency;
            $data->symbol = $this->symbol;
            $data->code = $this->code;

            if ($data->save()) {
                $this->emit('notification', ['Moneda actualizado exitosamente']);
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

        $this->currency = null;
        $this->symbol = null;
        $this->code = null;

        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Currency::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
