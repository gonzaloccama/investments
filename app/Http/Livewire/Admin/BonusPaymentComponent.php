<?php

namespace App\Http\Livewire\Admin;


use App\Models\Admin\Receipt;
use App\Models\Payment;
use App\Models\SystemConfig;
use Carbon\Carbon;

class BonusPaymentComponent extends BaseAdmin
{
    public $payment;
    public $investment;

    public $headers = [
        'code' => 'Inversión',
        'dni' => 'DNI',
        'amount' => 'Monto',
        'type_payment' => 'Tipo de pago',
        'payment_date' => 'Fecha de pago',
        'status' => 'Estado',

        'not' => '',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'end_date';
        $this->sort = 'desc';

        $this->frame = 'index';

        if (isset($_GET['investment']) && !empty($_GET['investment'])) {
            $this->investment = base64_decode($_GET['investment']);
        }
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'code', 'dni']);
        $findIn = [];
        $table = 'payments';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $findIn[] = 'users.dni';

        foreach (Payment::where('status', 'waiting')->whereDate('end_date', '<=', Carbon::today()->toDateString())->get() as $dt) {
            if ($dt->remaining_hours == 0 && Carbon::parse($dt->end_date)->format('Y-m-d') <= Carbon::today()->format('Y-m-d')) {
                $dt->status = 'pending';
                $dt->save();
            }
        }

        $data['results'] = Payment::orderBy($this->fieldSort, $this->sort)
            ->where($table . '.status', 'LIKE', $this->filter)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere('investments.code', 'LIKE', '%' . $this->keyWord . '%');
            })
            ->where('payments.type_payment', 'bonus')
            ->when($this->investment, function ($query) {
                $query->where('investment_id', 'LIKE', $this->investment);
            })
            ->select($table . '.*')
            ->selectRaw("investments.code, users.dni")
            ->join('investments', 'investments.id', '=', $table . '.investment_id')
            ->join('users', 'users.id', '=', 'investments.user_id')
            ->paginate($this->limit);

        $data['_title'] = 'Pagos de bonus';

        $this->emit('refreshContent');

        return view('livewire.admin.bonus-payment-component', $data)->layout('layouts.admin');
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $this->payment = Payment::find($this->itemId);

        $this->emit('refreshSection');
    }

    public function updateData()
    {

        if ($this->itemId) {
            $data = Payment::find($this->itemId);

            $data->payment_date = Carbon::now();
            $data->status = 'paid';

            if ($data->save()) {
                if ($data->investment->current_period < $data->investment->period && $data->current_period < $data->investment->period) {
                    $dt = new Payment();

                    $dt->investment_id = $data->investment->id;
                    $dt->amount = $data->investment->return_amount;
                    $dt->currency = $data->investment->currency;
                    $dt->type_payment = 'return';
                    $dt->current_period = $data->investment->current_period = $data->investment->current_period + 1;
                    $dt->start_date = Carbon::parse($data->start_date)->addMonths(1)->format('Y-m-d');
                    $dt->end_date = Carbon::parse($dt->start_date)->addMonths(1)->format('Y-m-d');

                    $dt->save();
                    $data->investment->save();

                }

                $this->receipt();

                $this->emit('notification', ['El pago se ha actualizado correctamente exitosamente']);
//                $this->closeFrame();
            }
        }
    }

    public function receipt()
    {
//        $id = base64_decode($_GET['id']);
//        $id = $_GET['id'];
        if ($this->itemId) {

            $pdf = app('dompdf.wrapper');
            $pdf->getDomPDF()->set_option("enable_php", true);
            $pdf->setPaper('A4');

            $data['config'] = SystemConfig::find(1);
            $data['payment'] = Payment::find($this->itemId);

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
        } else {
            return false;
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
        $data = Payment::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
