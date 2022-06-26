<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Reports\ContractComponent;
use App\Models\Admin\Receipt;
use App\Models\BankTransfer;
use App\Models\CashDeposit;
use App\Models\Investment;
use App\Models\Office;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\SystemConfig;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use PDF;

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
    public $office_id;

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
    public $update;
    public $modal;

    public $showFile;

    public $addUser;

    public $frame = 'index';

    public $headers = [
        'code' => 'Código',
        'dni' => 'DNI',
        'fullname' => 'Inversionista',
        'amount' => 'Monto',
        'start_date' => 'Inicio',
        'end_date' => 'Fin',
        'status' => 'Estado',
        'for_percent' => 'Progreso',

        'not' => '',
    ];

    protected $queryString = [
        'itemId' => ['except' => null, 'as' => 'id'],
    ];

    protected $attributes = [
        'code' => '<b><ins>Código</ins></b>',
        'user_id' => '<b><ins>Inversionista</ins></b>',
        'amount' => '<b><ins>Monto capital</ins></b>',
        'currency' => '<b><ins>Nominación</ins></b>',
        'period' => '<b><ins>Periodos</ins></b>',
        'plan' => '<b><ins>Plan</ins></b>',
        'start_date' => '<b><ins>Fecha de inicio</ins></b>',
        'end_date' => '<b><ins>Fecha de culminación</ins></b>',
        'return_amount' => '<b><ins>Monto de retorno</ins></b>',
        'progress' => '<b><ins>Progreso</ins></b>',
        'office_id' => '<b><ins>Oficina</ins></b>',
    ];
    protected $rules = [
//        'currency' => 'required',
        'period' => 'required',
        'plan' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
//        'office_id' => 'nullable',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'for_percent';
        $this->sort = 'desc';

        $this->start_date = Carbon::now()->format('Y-m-d');

        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->edit($_GET['id']);
        }
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname', 'for_percent', 'dni']);
        $findIn = [];
        $table = 'investments';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $findIn[] = 'users.dni';

        $data['results'] = Investment::orderBy($this->fieldSort, $this->sort)
            ->where($table . '.status', 'LIKE', $this->filter)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere(DB::raw("CONCAT(users.firstname, ' ', users.lastname)"), 'LIKE', '%' . $this->keyWord . '%');
            })
            ->when(auth()->user()->group == 3 && isset(auth()->user()->userOffice->status), function ($query) {
                $query->where('office_id', auth()->user()->userOffice->office_id);
            })
            ->select($table . '.*')
            ->selectRaw("
            CONCAT(users.firstname, ' ', users.lastname) as fullname, users.dni,
            IF(status='active', IF(TIMESTAMPDIFF(HOUR, CURDATE(), end_date) < 0, 0, TIMESTAMPDIFF(HOUR, CURDATE(), end_date)), null) as for_percent
            ")
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

        if ($this->period && $this->start_date && $this->plan) {
            $_times = 'add' . Plan::find($this->plan)->time->duration;
            $this->end_date = Carbon::parse($this->start_date)->$_times($this->period)->format('Y-m-d');
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
        if (in_array(auth()->user()->group, [1, 2])) {
            $rules = $this->rules;
            $this->validate(array_merge($rules, ['office_id' => 'required']), [], $this->attributes);
        } else {
            $this->validate($this->rules, [], $this->attributes);

            if (auth()->user()->userOffice) {
                if (auth()->user()->userOffice->status) {
                    $this->office_id = auth()->user()->userOffice->office_id;
                }
            }
        }

        $prefix = Office::find($this->office_id)->prefix;

        try {
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

            $today = Carbon::parse($this->start_date);
            $dt = Investment::whereDate('start_date', $today)->where('office_id', $this->office_id)->get();
            $i = 1;

            if ($dt) {
                $i = $dt->count() + 1;
            }

            $code = $months[$today->format('M')]
                . $today->format('d')
                . str_pad($i, 3, '0', STR_PAD_LEFT)
                . $today->format('y') . '-' . $prefix;

//            dd($code);

            $data = new Investment();

            $data->code = $code;
            $data->user_id = $this->userId;
            $data->amount = $this->amount;
            $data->currency = Plan::find($this->plan)->currency;
            $data->period = $this->period;
            $data->plan = $this->plan;
            $data->start_date = $this->start_date;
            $data->end_date = $this->end_date;
            $data->office_id = $this->office_id;
            $data->return_amount = $this->return_amount;

            if ($data->save()) {
                $this->emit('notification', ['Se creó nueva inversión exitosamente']);
                $this->cleanItems();
                $this->edit($data->id);
            }
        } catch (\Exception $e) {
            $this->emit('notification', ['Algo salió mal al crear nueva inversión', 'rgba(255,2,52,0.56)']);
        }
    }

    public function openPaint($paint)
    {
        $this->paint = 'paint-' . $paint;
        $this->emit('refreshSection');
    }

    public function openEdit()
    {
        $this->update = true;
        $this->emit('refreshSection');
    }

    public function saveEdit()
    {
//        if (auth()->user()->userOffice) {
//            if (auth()->user()->userOffice->status) {
//                $this->office_id = auth()->user()->userOffice->office_id;
//            }
//        }


        $this->validate($this->rules, [], $this->attributes);
        $data = Investment::find($this->itemId);

        $data->currency = Plan::find($this->plan)->currency;
        $data->period = $this->period;
        $data->plan = $this->plan;
        $data->start_date = $this->start_date;

        if (in_array(auth()->user()->group, [1, 2])) {
            $data->office_id = $this->office_id;
        }

        if ($data->save()) {
            $this->update = null;
            $this->emit('notification', ['Se guardó los cambios exitosamente']);
            $this->emit('refreshSection');
        }
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

    public function activeInvestment()
    {
//        $days = 'addWeeks';
//        $days = 'addYears';
//        $days = 'addMonths';
//        $days = 'addDays';
//        $days = 'addHours';
//        $days = 'addQuarters';
//        $days = 'addUnit';

//
        $dt = Investment::find($this->itemId);

        $_times = 'add' . $dt->isPlan->time->duration;

//        dd(Carbon::parse($dt->start_date)->$_times());

        $dt->status = 'active';
        $dt->current_period = 1;
        if ($dt->save()) {
            $this->emit('notification', ['Se activó la inversión exitosamente']);
            $pay = new Payment();
            $pay->investment_id = $this->itemId;
            $pay->amount = $dt->return_amount;
            $pay->currency = $dt->currency;
            $pay->type_payment = 'return';

            $pay->start_date = $dt->start_date;
            $pay->end_date = Carbon::parse($dt->start_date)->$_times(1)->format('Y-m-d');
            $pay->save();

//            $dt->user->group = 4;
//            $dt->user->save();
        }
    }

    private function updateInvestmentStatus()
    {
        $dt = Investment::find($this->itemId);
//        $dt->status = 'active';
        $dt->amount = $dt->cashDeposit->sum('amount') + $dt->bankTransfer->sum('amount');
        $dt->return_amount = ($dt->amount * $dt->isPlan->percent) / 100;
//        $dt->current_period = 1;
        $dt->save();
    }

    public function closePaint()
    {
        $this->paint = null;
        $this->update = null;

        $this->_amount = null;
        $this->attachment = null;

        $this->bank_id = null;
        $this->transfer_date = null;
        $this->transfer_account = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function openFile($id, $show)
    {
        if ($id) {
            $this->modal = 'modal-file';
            if ($show == 'cash') {
                $this->showFile = CashDeposit::find($id);

            } elseif ($show == 'bankTransfer') {
                $this->showFile = BankTransfer::find($id);
            }
            $this->emit('showModal');
        }
    }

    public function closeFile()
    {
        $this->modal = null;
        $this->showFile = null;
    }

    public function printAgreement(): \Illuminate\Http\Response
    {
        $id = base64_decode($_GET['id']);

        if (isset($id)) {
            $pdf = app('dompdf.wrapper');
            $pdf->getDomPDF()->set_option("enable_php", true);
            $pdf->setPaper('A4');

            $data['config'] = SystemConfig::find(1);
            $data['invest'] = Investment::find($id);

            $pdf->loadView('livewire.admin.investments.agreement', $data);

            $file = $data['invest']->user->lastname . '-' . $data['invest']->code . '-' . $data['invest']->created_at;

//            return $pdf->download($file . '.pdf');
            return $pdf->stream($file . '.pdf');
        }
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
        $this->office_id = $this->investment->office_id;

        $this->frame = 'edit';
        $this->emit('refreshSection');
    }

    public function updatePayment()
    {
        $isAccepted = $this->investment->inPayment()->latest('created_at')->first();

        if ($isAccepted->current_period == $this->investment->period && $this->investment->current_period == $this->investment->period) {
            if ($this->itemId) {
                $data = Investment::find($this->itemId);

                $data->status = 'completed';
                $data->progress = 100;
                $data->payment = true;
                $data->payment_date = Carbon::now()->format('Y-m-d H:i:s');

                if ($data->save()) {
                    $dt = new Payment();

                    $dt->investment_id = $data->id;
                    $dt->amount = $data->amount;
                    $dt->currency = $data->currency;
                    $dt->type_payment = 'capital';
                    $dt->payment_date = Carbon::now()->format('Y-m-d H:i:s');
                    $dt->status = 'paid';
                    $dt->start_date = $data->start_date;
                    $dt->end_date = $data->end_date;

                    $dt->save();

                    $this->receipt($dt->id);

                    $this->emit('notification', ['El pago de la inversión de ha actualizado exitosamente']);
                    $this->closeFrame();
                }
            }
        } else {
            $this->emit('notification', ['Falta completar los pagos de retorno '
                . $isAccepted->current_period . ' de ' . $this->investment->period . ' meses']);
        }
    }

    public function cancelInvestment()
    {
        if (Carbon::parse($this->investment->end_date)->format('Y-m-d') > Carbon::today()->format('Y-m-d')) {
//            dd('canceled');
            if ($this->itemId) {
                $data = Investment::find($this->itemId);

                $data->status = 'canceled';
                $data->payment = true;
                $data->payment_date = Carbon::now()->format('Y-m-d H:i:s');

                if ($data->save()) {
                    $dt = $data->inPayment()->where('type_payment', 'return')->whereNotIn('status', ['paid'])->latest('created_at')->first();
                    $dt->status = 'paid';
                    $dt->save();

                    $this->emit('notification', ['El pago se ha cancelado exitosamente']);
                    $this->closeFrame();
                }
            }
        }
    }


    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();

        $this->closePaint();
        $this->closeFile();
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
        $this->office_id = null;

        $this->_user = null;
        $this->investment = null;

        $this->frame = 'index';

        $this->addUser = null;

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

    /*** Add user***/

    public function openAddUser()
    {
        $this->addUser = true;
        $this->emit('showModal');
    }

    public function closeAddUser()
    {
        $this->addUser = null;

        $this->emit('closeModal');
    }

    public function customer($data)
    {
        $this->keyTex = $data[0];
        $this->updateSelectInvestment($data[1]);
        $this->closeAddUser();
    }

    /*** receipt refund capital ***/
    public function receipt($id)
    {
        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('A4');

        $data['config'] = SystemConfig::find(1);
        $data['payment'] = Payment::find($id);

        $pdf->loadView('livewire.admin.payments.details.receipt', $data);

        $path = public_path()
            . '/assets/uploads/receipts/';

        $file = 'recibo-'
            . str_pad($data['payment']->id, 6, '0', STR_PAD_LEFT) . '-'
            . $data['payment']->investment->code . '.pdf';

        $receipt = new Receipt();
        $receipt->investment_id = $data['payment']->investment->id;
        $receipt->payment_id = $data['payment']->id;
        $receipt->attachment = $file;

        if ($pdf->save($path . $file)) {
            $receipt->save();
            return true;
        } else {
            return false;
        }

//            return $pdf->download($file . '.pdf');
//        return $pdf->stream('recibo' . '.pdf');

    }
}
