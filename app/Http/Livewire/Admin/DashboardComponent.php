<?php

namespace App\Http\Livewire\Admin;

use App\Models\Investment;
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
        $data['_title'] = 'Dashboard';
        return view('livewire.admin.dashboard-component', $data)->layout('layouts.admin');
    }

    public function dailyReport()
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
}
