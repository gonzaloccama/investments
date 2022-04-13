<?php

namespace App\Http\Livewire\Admin;

use App\Models\BankTransfer;
use App\Models\CashDeposit;
use App\Models\Investment;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Livewire\WithFileUploads;

class InvestmentComponent extends BaseAdmin
{
    use WithFileUploads;

    public $code;
    public $user_id;
    public $amount;
    public $currency;
    public $period;
    public $plan;
    public $start_date;
    public $end_date;
    public $return_amount;
    public $progress;

    public $userId;
    public $keyTex;
    public $_user;

    public $investment;

    public $_amount;
    public $attachment;

    public $bank_id;
    public $transfer_date;
    public $transfer_account;

    public $paint;

    public $headers = [
        'code' => '#',
        'fullname' => 'Inversionista',
        'amount' => 'Monto',
        'start_date' => 'Inicio',
        'end_date' => 'Fin',
        'status' => 'Estado',
        'for_percent' => 'Progreso',

        'not' => '',
    ];

    protected $attributes = [
        'code' => '<b><ins>Moneda</ins></b>',
        'user_id' => '<b><ins>Simbolo</ins></b>',
        'amount' => '<b><ins>Código</ins></b>',
        'currency' => '<b><ins>Código</ins></b>',
        'period' => '<b><ins>Código</ins></b>',
        'plan' => '<b><ins>Código</ins></b>',
        'start_date' => '<b><ins>Código</ins></b>',
        'end_date' => '<b><ins>Código</ins></b>',
        'return_amount' => '<b><ins>Código</ins></b>',
        'progress' => '<b><ins>Código</ins></b>',
    ];
    protected $rules = [
        'currency' => 'required',
        'period' => 'required',
        'plan' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'created_at';
        $this->sort = 'desc';

        $this->frame = 'index';

        $this->start_date = Carbon::now()->format('Y-m-d');
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname', 'for_percent']);
        $findIn = [];
        $table = 'investments';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Investment::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere(DB::raw("CONCAT(users.firstname, ' ', users.lastname)"), 'LIKE', '%' . $this->keyTex . '%');
            })
            ->select($table . '.*')
            ->selectRaw("CONCAT(users.firstname, ' ', users.lastname) as fullname, IF(status='active', DATEDIFF(CURDATE(),end_date), null) as for_percent")
            ->join('users', 'users.id', '=', 'user_id')
            ->paginate($this->limit);

        if ($this->keyTex && !($this->keyTex == '')) {
            $data['_users'] = User::orderBy('firstname', 'asc')
                ->where(function ($query) {
                    $query->orWhere('dni', 'LIKE', '%' . $this->keyTex . '%');
                    $query->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'LIKE', '%' . $this->keyTex . '%');
                })
                ->whereNotIn('group', [1])
                ->paginate(5);
        }

        if ($this->period && $this->start_date) {
            $this->end_date = Carbon::parse($this->start_date)->addMonths($this->period)->format('Y-m-d');
        }

        $data['_title'] = 'Inversiones';

        $this->emit('refreshContent');

        return view('livewire.admin.investment-component', $data)->layout('layouts.admin');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }


    // BEGIN DYNAMIC METHODS

    public function updateSelectInvestment($id)
    {
        $this->userId = $id;

        if ($this->userId) {
            $this->_user = \App\Models\User::find($this->userId);
        }
    }

    public function openFrame()
    {
        $this->frame = 'add';
        $this->emit('refreshSection');
    }

    public function openCreateInvestment()
    {
        $this->frame = 'new';

        $this->emit('refreshSection');
    }

    public function saveData()
    {
//        $this->validate($this->rules, [], $this->attributes);
        $months = [
            'Jan' => 'ENE',
            'Feb' => 'FEB',
            'Mar' => 'MAR',
            'Apr' => 'ABR',
            'May' => 'MAY',
            'Jun' => 'JUN',
            'Jul' => 'JUL',
            'Aug' => 'AGO',
            'Sep' => 'SEP',
            'Oct' => 'OCT',
            'Nov' => 'NOV',
            'Dec' => 'DIC',
        ];

        $today = Carbon::today();
        $dt = Investment::whereDate('created_at', $today)->get();
        $i = 1;

        if ($dt) {
            $i = $dt->count() + 1;
        }

        $code = $months[$today->format('M')]
            . $today->format('d')
            . str_pad($i, 3, '0', STR_PAD_LEFT)
            . $today->format('y');

        $data = new Investment();

        $data->code = $code;
        $data->user_id = $this->userId;
        $data->amount = $this->amount;
        $data->currency = $this->currency;
        $data->period = $this->period;
        $data->plan = $this->plan;
        $data->start_date = $this->start_date;
        $data->end_date = $this->end_date;
        $data->return_amount = $this->return_amount;

//        dd($data);

        if ($data->save()) {
            $this->emit('notification', ['Se creó nueva moneda exitosamente']);
            $this->cleanItems();
            $this->edit($data->id);
        }
    }

    public function openPaint($paint)
    {
        $this->paint = 'paint-' . $paint;
        $this->emit('refreshSection');
    }

    public function saveInPaint()
    {
        if ($this->paint == 'paint-cash') {
            $this->validate(
                ['_amount' => 'required', 'attachment' => 'required'],
                [],
                ['_amount' => '<b>Monto</b>', 'attachment' => '<b>Evidencia</b>'],
            );

            if ($this->attachment) {
                $fileSourceName = Carbon::now()->timestamp . '.' . $this->attachment->extension();
                $this->attachment->storeAs('uploads/investment/', $fileSourceName);
            }


            $data = new CashDeposit();

            $data->investment_id = $this->investment->id;
            $data->user_id = $this->_user->id;
            $data->amount = $this->_amount;
            $data->attachment = $fileSourceName;

            if ($data->save()) {
                $this->updateInvestmentStatus();

                $this->closePaint();
                $this->emit('notification', ['Se agregó fondos exitosamente']);
            }

        } elseif ($this->paint == 'paint-bank-transfer') {
            $this->validate(
                ['_amount' => 'required', 'attachment' => 'required'],
                [],
                ['_amount' => '<b>Monto</b>', 'attachment' => '<b>Evidencia</b>'],
            );

            if ($this->attachment) {
                $fileSourceName = Carbon::now()->timestamp . '.' . $this->attachment->extension();
                $this->attachment->storeAs('uploads/investment/', $fileSourceName);
            }


            $data = new BankTransfer();

            $data->investment_id = $this->investment->id;
            $data->user_id = $this->_user->id;
            $data->amount = $this->_amount;
            $data->bank_id = $this->bank_id;
            $data->transfer_date = $this->transfer_date;
            $data->transfer_account = $this->transfer_account;
            $data->attachment = $fileSourceName;

            if ($data->save()) {
                $this->updateInvestmentStatus();

                $this->closePaint();
                $this->emit('notification', ['Se agregó fondos exitosamente']);
            }
        }
    }

    private function updateInvestmentStatus()
    {
        $dt = Investment::find($this->itemId);

        $dt->status = 'active';
        $dt->amount = $dt->cashDeposit->sum('amount') + $dt->bankTransfer->sum('amount');
        $dt->return_amount = ($dt->amount * $dt->isPlan->percent) / 100;
        $dt->current_period = 1;
        $dt->save();
    }

    public function closePaint()
    {
        $this->paint = null;

        $this->_amount = null;
        $this->attachment = null;

        $this->bank_id = null;
        $this->transfer_date = null;
        $this->transfer_account = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function edit($id = 0)
    {

        $this->itemId = $id;

        $this->investment = Investment::find($this->itemId);

        $this->_user = $this->investment->user;

        $this->code = $this->investment->code;
        $this->userId = $this->investment->user_id;
        $this->amount = $this->investment->amount;
        $this->currency = $this->investment->currency;
        $this->period = $this->investment->period;
        $this->plan = $this->investment->plan;
        $this->start_date = $this->investment->start_date;
        $this->end_date = $this->investment->end_date;
        $this->return_amount = $this->investment->return_amount;

        $this->frame = 'edit';
        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $data = Investment::find($this->itemId);

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
        $this->closePaint();
    }

    public function cleanItems()
    {
        $this->itemId = null;
        $this->deleteId = null;

        $this->userId = null;
        $this->keyTex = null;

        $this->code = null;
        $this->user_id = null;
        $this->amount = null;
        $this->currency = null;
        $this->period = null;
        $this->plan = null;
        $this->start_date = Carbon::now()->format('Y-m-d');
        $this->end_date = null;
        $this->return_amount = null;
        $this->progress = null;

        $this->_user = null;
        $this->investment = null;

        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = Investment::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
