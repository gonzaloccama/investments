<?php

namespace App\Http\Livewire\Admin;

use App\Models\Investment;
use App\Models\Payment;
use App\Models\SystemConfig;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use DatePeriod;
use DB;
use Livewire\Component;

class DashboardComponent extends BaseAdmin
{
    public function mount()
    {
        $this->frame = 'index';
    }

    public function render()
    {
        foreach (Payment::where('status', 'waiting')->whereDate('end_date', '<=', Carbon::today()->toDateString())->get() as $dt) {
            if ($dt->remaining_hours == 0 && Carbon::parse($dt->end_date)->format('Y-m-d') <= Carbon::today()->format('Y-m-d')) {
                $dt->status = 'pending';
                $dt->save();
            }
        }

        $data['pe'] = $this->getForGraphic(1);
        $data['dollar'] = $this->getForGraphic(2);

        $data['_title'] = 'Dashboard';
        return view('livewire.admin.dashboard-component', $data)->layout('layouts.admin');
    }

    public function dailyReport()//not working
    {
//        $id = base64_decode($_GET['id']);

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('A4');

        $data['config'] = SystemConfig::find(1);
        $data['investments'] = Investment::whereDate('created_at', Carbon::today())->whereIn('status', ['active'])->get();

        $pdf->loadView('livewire.admin.dashboard.daily-report', $data);

        $file = 'REPORTE-' . Carbon::now()->format('Y-m-d H:i:s');

        return $pdf->stream($file . '.pdf');

    }

    public function allWeek($filter, $currency)
    {
        $results = Investment::whereBetween('created_at', [Carbon::now()->subDays(6)->format('Y-m-d') . " 00:00:00", Carbon::now()->format('Y-m-d') . " 23:59:59"])
            ->whereIn('status', $filter)
            ->where('currency', $currency)
            ->groupBy('date')
            ->orderBy('date')
            ->get([
                DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as date'),
                DB::raw('sum(amount) as total')
            ])
            ->keyBy('date')
            ->map(function ($item) {
                $item->date = Carbon::parse($item->date);
                return $item;
            });

        $period = new DatePeriod(Carbon::now()->subDays(6), CarbonInterval::day(), Carbon::now()->addDay());

        $amount = array_map(function ($datePeriod) use ($results) {
            $date = $datePeriod->format('Y-m-d');
            return $results->has($date) ? (float)$results->get($date)->total : 0;
        }, iterator_to_array($period));


        $dates = array_map(function ($datePeriod) use ($results) {
            $days = ['Mon' => 'Lun', 'Tue' => 'Mar', 'Wed' => 'Mie', 'Thu' => 'Jue', 'Fri' => 'Vie', 'Sat' => 'Sab', 'Sun' => 'Dom'];
            return $days[$datePeriod->format('D')];
        }, iterator_to_array($period));

        return ['amount' => $amount, 'dates' => $dates];
    }

    public function allMonths($filter, $currency)
    {
//        DB::enableQueryLog();
        $results = Investment::whereBetween('start_date', [Carbon::now()->subMonths(11)->format('Y-m') . "-1 00:00:00", Carbon::now()->format('Y-m-d') . " 23:59:59"])
            ->whereIn('status', $filter)
            ->where('currency', $currency)
            ->groupBy('month')
            ->orderBy('month')
            ->get([
                DB::raw('MONTH(start_date) as month'),
//                DB::raw('MONTH(created_at) as month'),
                DB::raw('sum(amount) as total')
            ])
            ->keyBy('month');
//            ->map(function ($item) {
//                $item->month = Carbon::parse($item->month);
//                return $item;
//            });

        $period = new DatePeriod(Carbon::now()->subMonths(11), CarbonInterval::month(), Carbon::now()->addMonth());

        $amount = array_map(function ($datePeriod) use ($results) {
            $month = (int)$datePeriod->format('m');
            return $results->has($month) ? (float)$results->get($month)->total : 0;
        }, iterator_to_array($period));

        $dates = array_map(function ($datePeriod) use ($results) {
            $months = [
                "Jan" => 'Ene', "Feb" => 'Feb', "Mar" => 'Mar', "Apr" => 'Abr',
                "May" => 'May', "Jun" => 'Jun', "Jul" => 'Jul', "Aug" => 'Ago',
                "Sep" => 'Sep', "Oct" => 'Oct', "Nov" => 'Nov', "Dec" => 'Dic'
            ];
            return $months[$datePeriod->format('M')];
        }, iterator_to_array($period));

        return ['amount' => $amount, 'months' => $dates];
    }

    private function getForGraphic($curr): array
    {
        $data = null;

        $is_office = null;
        $_off_id = null;

        if (isset(auth()->user()->userOffice)) {
            if (auth()->user()->userOffice->status) {
                $is_office = (auth()->user()->userOffice->status && auth()->user()->group == 3);
                $_off_id = auth()->user()->userOffice->office_id;
            }
        }

        $data['total'] = \App\Models\Investment::whereIn('status', ['completed', 'active'])
            ->when($is_office, function ($query) use ($_off_id) {
                $query->where('office_id', $_off_id);
            })->where('currency', $curr)->sum('amount');

        $data['total_today'] = \App\Models\Investment::whereIn('status', ['completed', 'active'])
            ->when($is_office, function ($query) use ($_off_id) {
                $query->where('office_id', $_off_id);
            })->where('currency', $curr)->whereDate('created_at', Carbon::today())->sum('amount');

        $data['paid'] = \App\Models\Payment::whereIn('payments.status', ['paid'])->where('payments.currency', $curr)
            ->when($is_office, function ($query) use ($_off_id) {
                $query->where('investments.office_id', $_off_id);
            })->join('investments', 'investments.id', '=', 'payments.investment_id')
            ->where('payments.type_payment', 'return')->whereDate('payments.payment_date', Carbon::today())->sum('payments.amount');

        $data['paid_pending'] = \App\Models\Payment::whereIn('payments.status', ['pending'])
            ->when($is_office, function ($query) use ($_off_id) {
                $query->where('investments.office_id', $_off_id);
            })->join('investments', 'investments.id', '=', 'payments.investment_id')
            ->where('payments.currency', $curr)->sum('payments.amount');

        return $data;
    }
}
