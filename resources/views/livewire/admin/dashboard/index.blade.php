<div class="col-md-12">
    <div class="icon-cards-row">

        <div class="glide dashboard-numbers">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-wallet"></i>
                                <p class="card-text mb-0">Inversión en Soles (S/)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S/ ' . number_format($pe['total'], 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-coins"></i>
                                <p class="card-text mb-0">Inversiones hoy (S/)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S/ ' . number_format($pe['total_today'], 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-financial"></i>
                                <p class="card-text mb-0">Salidas por retorno hoy</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S/ ' . number_format($pe['paid'], 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-safe-box"></i>
                                <p class="card-text mb-0">Salidas pendientes</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ 'S/ ' . number_format($pe['paid_pending'], 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<div class="col-md-12">
    <div class="icon-cards-row">

        <div class="glide dashboard-dollar">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-wallet"></i>
                                <p class="card-text mb-0">Inversión en dolares ($)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ '$ ' . number_format($dollar['total'], 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-coins"></i>
                                <p class="card-text mb-0">Inversiones hoy ($)</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ '$ ' . number_format($dollar['total_today'], 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-financial"></i>
                                <p class="card-text mb-0">Salidas por retorno hoy</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ '$ ' . number_format($dollar['paid'], 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-safe-box"></i>
                                <p class="card-text mb-0">Salidas pendientes</p>
                                <p class="lead text-center" style="font-size: 1.4rem !important;">
                                    {{ '$ ' . number_format($dollar['paid_pending'], 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

<div class="col-md-6 col-sm-12 mb-4">
    <div id="data-days" hidden>
        {{ json_encode($this->allWeek(['completed', 'active'], 1)['dates']) }}
    </div>
    <div id="data-amount" hidden>
        {{ json_encode($this->allWeek(['completed', 'active'], 1)["amount"]) }}
    </div>
    <div class="card dashboard-filled-line-chart">
        <div class="card-body pb-0 mb-0">
            <div class="float-left float-none-xs">
                <div class="d-inline-block">
                    <h5 class="d-inline">Inversiones en Soles (S/)</h5>
                    <span class="text-muted text-small d-block">Inversiones en la semana</span>
                </div>
            </div>
        </div>
        <div class="chart card-body pt-0">
            <canvas id="charPEN"></canvas>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12 mb-4">
    <div id="data-days-dollar" hidden>
        {{ json_encode($this->allWeek(['completed', 'active'], 2)['dates']) }}
    </div>
    <div id="data-amount-dollar" hidden>
        {{ json_encode($this->allWeek(['completed', 'active'], 2)["amount"]) }}
    </div>
    <div class="card dashboard-filled-line-chart">
        <div class="card-body  pb-0 mb-0">
            <div class="float-left float-none-xs">
                <div class="d-inline-block">
                    <h5 class="d-inline">Inversiones en Dolares ($)</h5>
                    <span class="text-muted text-small d-block">Inversiones en la semana</span>
                </div>
            </div>
        </div>
        <div class="chart card-body pt-0">
            <canvas id="charDOLLAR"></canvas>
        </div>
    </div>
</div>

{{--{{ json_encode($this->allMonths(['completed', 'active'], 1)) }}--}}

<div class="col-md-6 col-sm-12 mb-4">
    <div id="data-year-days" hidden>
        {{ json_encode($this->allMonths(['completed', 'active'], 1)['months']) }}
    </div>
    <div id="data-year-amount" hidden>
        {{ json_encode($this->allMonths(['completed', 'active'], 1)["amount"]) }}
    </div>
    <div class="card dashboard-filled-line-chart">
        <div class="card-body pb-0 mb-0">
            <div class="float-left float-none-xs">
                <div class="d-inline-block">
                    <h5 class="d-inline">Inversiones en Soles (S/)</h5>
                    <span class="text-muted text-small d-block">Inversiones en el año</span>
                </div>
            </div>
        </div>
        <div class="chart card-body pt-0">
            <canvas id="charYearPEN"></canvas>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12 mb-4">
    <div id="data-year-days-us" hidden>
        {{ json_encode($this->allMonths(['completed', 'active'], 2)['months']) }}
    </div>
    <div id="data-year-amount-us" hidden>
        {{ json_encode($this->allMonths(['completed', 'active'], 2)["amount"]) }}
    </div>
    <div class="card dashboard-filled-line-chart">
        <div class="card-body pb-0 mb-0">
            <div class="float-left float-none-xs">
                <div class="d-inline-block">
                    <h5 class="d-inline">Inversiones en Dólares ($)</h5>
                    <span class="text-muted text-small d-block">Inversiones en el año</span>
                </div>
            </div>
        </div>
        <div class="chart card-body pt-0">
            <canvas id="charYearUSD"></canvas>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="mt-3">
        <a href="{{ route('daily.report') }}" class="btn btn-secondary">Reportes diarios</a>
    </div>
</div>

@if(in_array(auth()->user()->group, [1,2]))

    <?php
    $offices = \App\Models\Office::all();
    ?>

    <div class="col-md-12">
        <div class="icon-cards-row mt-5">
            <h4 class="card-title col-md-12">Pagos pendientes (S/)</h4>
            <div class="glide dashboard-offices mt-0 pt-0">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach($offices as $office)
                            <?php
                            $g = $office->investments()
                                ->where('investments.currency', 1)
                                ->where('payments.status', 'pending')
                                ->where('payments.type_payment', 'return')
                                ->join('payments', 'investments.id', '=', 'payments.investment_id')
                                ->sum('payments.amount')
                            ?>
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsminds-location-2"></i>
                                        <p class="card-text mb-0">{{ $office->office }}</p>
                                        <p class="lead text-center" style="font-size: 1.4rem !important;">
                                            {{ 'S/ ' . number_format($g, 2, '.', ',') }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12">
        <div class="icon-cards-row mt-5">
            <h4 class="card-title col-md-12">Pagos pendientes ($)</h4>
            <div class="glide dashboard-offices-dollar mt-0 pt-0">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach($offices as $office)
                            <?php
                            $g = $office->investments()
                                ->where('investments.currency', 2)
                                ->where('payments.status', 'pending')
                                ->where('payments.type_payment', 'return')
                                ->join('payments', 'investments.id', '=', 'payments.investment_id')
                                ->sum('payments.amount')
                            ?>
                            <li class="glide__slide">
                                <a href="#" class="card">
                                    <div class="card-body text-center">
                                        <i class="iconsminds-location-2"></i>
                                        <p class="card-text mb-0">{{ $office->office }}</p>
                                        <p class="lead text-center" style="font-size: 1.4rem !important;">
                                            {{ '$ ' . number_format($g, 2, '.', ',') }}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>

    </div>

@endif
