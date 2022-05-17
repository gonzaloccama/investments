@if(!in_array($investment->status, ['active', 'completed', 'canceled']) && !$investment->amount)
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-secondary icon-button"
                wire:click.prevent="openEdit">
            <i class="fe-edit"></i>
        </button>
    </div>
@endif

<h5 class="card-title">Detalles de la Inversión</h5>

@if($investment->amount < $investment->isPlan->min_amount)
    <div class="alert alert-danger"><i class="fe-alert-triangle"></i>
        Los fondos de la inversión debe ser como mínimo <b>
            {{ $investment->isCurrency->symbol . ' ' . number_format($investment->isPlan->min_amount, 2, '.', ',') }}
        </b> para ser activado
    </div>
@endif

<table class="table">
    <tr>
        <th class="text-theme-1">Codigo:</th>
        <td>{{ $code }}</td>
    </tr>
    <tr>
        <th class="text-theme-1">Modeda:</th>
        <td>{{ $investment->isCurrency->symbol.' ('.$investment->isCurrency->currency.')' }}</td>
    </tr>
    <tr>
        <th class="text-theme-1">Meses:</th>
        <td>
            <b class="text-theme-1 font-14">{{ $investment->current_period  }}</b>
            {{ ' de ' . $period.' meses' }}
        </td>
    </tr>
    <tr>
        <th class="text-theme-1">Plan:</th>
        <td>{!! $investment->isPlan->name . ' &#8212; ' . $investment->isPlan->percent . '%' !!}</td>
    </tr>
    <tr>
        <th class="text-theme-1">Fecha de Inicio:</th>
        <td>
            <?php
            echo ucfirst(Carbon\Carbon::parse($start_date)
                ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
            ?>
        </td>
    </tr>
    <tr>
        <th class="text-theme-1">Fecha de culminación:</th>
        <td>
            <?php
            echo ucfirst(Carbon\Carbon::parse($end_date)
                ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
            ?>
        </td>
    </tr>
    <tr>
        <th class="text-theme-1">Progreso:</th>
        <td>
            @if(in_array($investment->status, ['active', 'completed']))
                {{ __('Faltan: ') . intdiv($investment->remaining_hours, 24) . ' días, ' . ($investment->remaining_hours % 24) . ' horas' }}
                <br>

                <?php

                $perc = $investment->percent;

                $prc = $perc > 97 ? '#317347' : '#1D477A';
                if ($investment->status == 'canceled') {
                    $prc = '#f63c44';
                }
                ?>

                <div class="progress-outer w-100" style="border-color:{{ $prc }};">
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped"
                             style="width:{{ $perc }}%; background-color: {{ $prc }};"></div>
                        <div class="progress-value" style="color: {{ $prc }};">
                            <span>{{ $perc }}</span>%
                        </div>
                    </div>
                </div>
            @else
                <span class="rounded-0 badge badge-inactive">
                                               {{ __('Inactivo') }}
                                            </span>
            @endif

        </td>
    </tr>
    <tr>
        <th class="text-theme-1">Estado:</th>
        <td>
            <span class="rounded-0 badge badge-{{  $investment->status }}">
               {{ $_status[ $investment->status] }}
            </span>
        </td>
    </tr>
</table>
