<?php

namespace App\Http\Livewire\Admin;

use App\Models\Bonus;
use App\Models\Investment;
use Carbon\Carbon;
use Livewire\Component;
use Validator;

class BonusComponent extends BaseAdmin
{
    public $code;
    public $investment_id;
    public $referred_to;
    public $type;
    public $percent;
    public $amount;
    public $status;

    public $investment;

    public $headers = [
        'code' => 'Código',
        'inCode' => 'Inversión',
        'type' => 'Tipo de bonus',
        'percent' => 'Porcentaje',
        'status' => 'Estado',

//        'not' => '',
    ];

    protected $attributes = [
        'code' => '<b><ins>Código</ins></b>',
        'investment_id' => '<b><ins>Inversión</ins></b>',
        'referred_to' => '<b><ins>DNI del referido</ins></b>',
        'type' => '<b><ins>Tipo</ins></b>',
        'percent' => '<b><ins>Porcentaje</ins></b>',
        'amount' => '<b><ins>Monto</ins></b>',
        'status' => '<b><ins>Estado</ins></b>',
    ];
    protected $rules = [
//        'code' => 'required|min:3',
//        'investment_id' => 'required',
        'referred_to' => 'required|digits:8|unique:users,dni|unique:bonuses',
        'type' => 'required',
        'percent' => 'required',
//        'amount' => 'nullable',
//        'status' => 'nullable',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'created_at';
        $this->sort = 'desc';

        $this->frame = 'index';

        $this->status = 1;
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'inCode']);
        $findIn = [];
        $table = 'bonuses';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $findIn[] = 'investments.code';

        $data['results'] = Bonus::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->select($table . '.*')
            ->selectRaw('investments.code as inCode')
            ->join('investments', 'investments.id', '=', $table . '.investment_id')
            ->paginate($this->limit);

        if ($this->investment_id) {
            $this->investment = Investment::find($this->investment_id);
        }

        $data['_title'] = 'Bonus';

        $this->emit('refreshContent');

        return view('livewire.admin.bonus-component', $data)->layout('layouts.admin');
    }

    public function updated($property)
    {
        $rules = $this->rules;

        if ($this->type == 'referred') {
            $rules = array_merge($rules, ['investment_id' => 'required|exists_ref']);
        } elseif ($this->type == 'invest') {
            unset($rules['referred_to']);
            $rules = array_merge($rules, ['investment_id' => 'required|exists30high|exists_bonus']);
        } else {
            unset($rules['referred_to']);
            $rules = array_merge($rules, ['investment_id' => 'required|exists30k|exists_bonus']);
        }
        $this->customValidation();
        $this->validateOnly($property, $rules,
            [
                'investment_id.exists_ref' => 'La :attribute no debe tener más de <b>Un Referido</b>.',
                'investment_id.exists30k' => 'La :attribute debe tener más de <b>30K de monto invertido</b>.',
                'investment_id.exists30high' => 'La :attribute debe tener más de <b>30K de monto invertido</b>.',
                'investment_id.exists_bonus' => 'La :attribute no debe tener más de <b>Un Bono Reclamado</b>.',
            ],
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
        $rules = $this->rules;

        if ($this->type == 'referred') {
            $rules = array_merge($rules, ['investment_id' => 'required|exists_ref']);
        } elseif ($this->type == 'invest') {
            unset($rules['referred_to']);
            $rules = array_merge($rules, ['investment_id' => 'required|exists30high|exists_bonus']);
        } else {
            unset($rules['referred_to']);
            $rules = array_merge($rules, ['investment_id' => 'required|exists30k|exists_bonus']);
        }

        $this->customValidation();
        $this->validate($rules,
            [
                'investment_id.exists_ref' => 'La :attribute no debe tener más de <b>Un Referido</b>.',
                'investment_id.exists30k' => 'La :attribute debe tener más de <b>30K de monto invertido</b>.',
                'investment_id.exists30high' => 'La :attribute debe tener más de <b>30K de monto invertido</b>.',
                'investment_id.exists_bonus' => 'La :attribute no debe tener más de <b>Un Bono Reclamado</b>.',
            ],
            $this->attributes);

        $data = new Bonus();

        $data->code = $this->generateUniqueCode();
        $data->investment_id = $this->investment_id;
        $data->type = $this->type;
        $data->percent = $this->percent;
        $data->amount = $this->percent * $this->investment->amount / 100;

        if ($this->type == 'referred') {
            $data->referred_to = $this->referred_to;
        }

        if ($data->save()) {
            $this->investment->referred_id = $data->id;
            $this->investment->save();

            $this->emit('notification', ['Se creó un nuevo Bonus exitosamente']);
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

        $this->code = null;
        $this->investment_id = null;
        $this->type = null;
        $this->percent = null;
        $this->amount = null;
        $this->status = null;
        $this->referred_to = null;


        $this->investment = null;

        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Bonus::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }

    /*****/

    /**
     * @throws \Exception
     */
    private function generateUniqueCode()
    {
        do {
            $rand_number = random_int(100000, 999999);
            $code = mb_convert_case(substr($this->type, 0, 3), MB_CASE_UPPER, "UTF-8") . $rand_number;
        } while (substr(Bonus::where('code', '=', $code)->first(), 3));

        return $code;
    }

    private function customValidation()
    {
        Validator::extend('exists_ref', function ($attr, $value) {
            $validate = Bonus::where('investment_id', $value)->where('type', 'referred')->first();
            return !(bool)$validate;
        });

        Validator::extend('exists30high', function ($attr, $value) {
            $validate = Investment::where('id', $value)->whereIn('status', ['completed', 'active'])->where('amount', '>', 30000)->first();
            return (bool)$validate;
        });

        Validator::extend('exists30k', function ($attr, $value) {
            $validate = Investment::where('id', $value)->whereIn('status', ['completed', 'active'])->where('amount', '>=', 30000)->first();
            return (bool)$validate;
        });

        Validator::extend('exists_bonus', function ($attr, $value) {
            $validate = Bonus::where('investment_id', $value)->where('type', 'invest')->first();
            return !(bool)$validate;
        });
    }
}
