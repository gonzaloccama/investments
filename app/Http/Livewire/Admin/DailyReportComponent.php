<?php

namespace App\Http\Livewire\Admin;

use App\Models\DailyReport;
use App\Models\Investment;
use App\Models\SystemConfig;
use Carbon\Carbon;
use File;

class DailyReportComponent extends BaseAdmin
{
    public $modal;
    public $report;

    public $headers = [
        'id' => '#',
        'type_report' => 'Reporte',
        'created_at' => 'fecha',

        'not' => '',
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
        $table = 'daily_reports';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $data['results'] = DailyReport::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
            })
            ->paginate($this->limit);

        $data['_title'] = 'Reportes Diarios';

        $this->emit('refreshContent');

        return view('livewire.admin.daily-report-component', $data)->layout('layouts.admin');
    }

    public function openFrame()
    {
        $report = new DailyReport();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->setPaper('A4');

        $data['config'] = SystemConfig::find(1);
        $data['investments'] = Investment::whereDate('created_at', Carbon::today())->whereIn('status', ['active'])->get();
        $data['created_at'] = Carbon::now()->format('Y-m-d|H-i-s');

        if ($d = DailyReport::latest('created_at')->first()) {
            if (Carbon::parse($d->created_at)->year == Carbon::now()->year) {
                $data['next'] = $report->increase = $report->next();
            } else {
                $data['next'] = $report->increase = 1;
            }
        } else {
            $data['next'] = $report->increase = 1;
        }

        $pdf->loadView('livewire.admin.dashboard.daily-report', $data);

        $file = 'REPORTE-' . Carbon::now()->format('Y-m-d--H-i-s') . '.pdf';
        $path = public_path()
            . '/assets/uploads/daily-reports/';

        $report->type_report = 'reporte diario';
        $report->attachment = $file;

        if ($pdf->save($path . $file)) {
            $report->save();
            return true;
        } else {
            return false;
        }

//            return $pdf->download($file . '.pdf');
//        return $pdf->stream('recibo' . '.pdf');

    }

    public function showModal($id)
    {
        $this->modal = 'show-modal';

        $this->itemId = $id;
        $this->report = DailyReport::find($this->itemId);

        $this->emit('showModal');
    }

    public function closeModal()
    {
        $this->modal = null;
        $this->cleanItems();
    }

    public function cleanItems()
    {
        $this->itemId = null;
        $this->deleteId = null;

        $this->frame = 'index';
        $this->report = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {

        $data = DailyReport::find($this->deleteId);

        $file = $data->attachment;

//        dd(public_path('assets/uploads/daily-reports/' . $file));

        if ($data->delete()) {
            File::delete([
                public_path('assets/uploads/daily-reports/' . $file),
            ]);
            $this->cleanItems();
        }
    }
}
