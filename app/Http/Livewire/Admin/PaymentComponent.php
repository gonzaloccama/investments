<?php

namespace App\Http\Livewire\Admin;

use App\Models\Payment;
use Livewire\Component;

class PaymentComponent extends BaseAdmin
{
    public $headers = [
        'code' => 'Inversión',
        'amount' => 'Monto',
        'type_payment' => 'Tipo de pago',
        'start_date' => 'Inicio',
        'end_date' => 'Fin',
        'remaining' => 'Faltan',
        'payment_date' => 'Fecha de pago',
        'status' => 'Estado',

//        'not' => '',
    ];

    protected $attributes = [
        'name' => '<b><ins>Nombre</ins></b>',
    ];
    protected $rules = [
        'name' => 'required|min:3',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'end_date';
        $this->sort = 'asc';

        $this->frame = 'index';
    }

    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['code', 'remaining']);
        $findIn = [];
        $table = 'payments';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = Payment::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere('investments.code', 'LIKE', '%' . $this->keyWord . '%');
            })
            ->select($table . '.*')
            ->selectRaw("investments.code, CONCAT(DATEDIFF(payments.end_date, CURDATE()),' días') as remaining")
            ->join('investments', 'investments.id', '=', $table . '.investment_id')
            ->paginate($this->limit);

        $data['_title'] = 'Todos los pagos';

        $this->emit('refreshContent');

        return view('livewire.admin.payment-component', $data)->layout('layouts.admin');
    }
}
