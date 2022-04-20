<div class="col-md-12">
    <div class="icon-cards-row">
        <div class="glide dashboard-numbers">
            <div class="glide__track" data-glide-el="track">
                <?php
                use Carbon\Carbon;
                $total_pen = \App\Models\Investment::whereIn('status', ['completed', 'active'])->where('currency', 1)->sum('amount');
                $total_today = \App\Models\Investment::whereIn('status', ['completed', 'active'])->where('currency', 1)->whereDate('created_at', Carbon::today())->sum('amount');
                $paid = \App\Models\Payment::whereIn('status', ['paid'])->where('currency', 1)->where('type_payment', 'return')->whereDate('payment_date', Carbon::today())->sum('amount');
                $paid_pending = \App\Models\Payment::whereIn('status', ['pending'])->where('currency', 1)->sum('amount');
                ?>
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-wallet"></i>
                                <p class="card-text mb-0">Inversión en Soles (S/)</p>
                                <p class="lead text-center">
                                    {{ 'S/ ' . number_format($total_pen, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-coins"></i>
                                <p class="card-text mb-0">Inversiones hoy (S/)</p>
                                <p class="lead text-center">
                                    {{ 'S/ ' . number_format($total_today, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-financial"></i>
                                <p class="card-text mb-0">Salidas por retorno hoy</p>
                                <p class="lead text-center">
                                    {{ 'S/ ' . number_format($paid, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-safe-box"></i>
                                <p class="card-text mb-0">Salidas pendientes</p>
                                <p class="lead text-center">{{ 'S/ ' . number_format($paid_pending, 2, '.', ',') }}</p>
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
                <?php
                $total_dol = \App\Models\Investment::whereIn('status', ['completed', 'active'])->where('currency', 2)->sum('amount');
                $total_today_dol = \App\Models\Investment::whereIn('status', ['completed', 'active'])->where('currency', 2)->whereDate('created_at', Carbon::today())->sum('amount');
                $paid_dol = \App\Models\Payment::whereIn('status', ['paid'])->where('currency', 2)->where('type_payment', 'return')->whereDate('payment_date', Carbon::today())->sum('amount');
                $paid_pending_dol = \App\Models\Payment::whereIn('status', ['pending'])->where('currency', 2)->sum('amount');
                ?>
                <ul class="glide__slides">
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-wallet"></i>
                                <p class="card-text mb-0">Inversión en Soles ($)</p>
                                <p class="lead text-center">
                                    {{ '$ ' . number_format($total_dol, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-coins"></i>
                                <p class="card-text mb-0">Inversiones hoy ($)</p>
                                <p class="lead text-center">
                                    {{ '$ ' . number_format($total_today_dol, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-financial"></i>
                                <p class="card-text mb-0">Salidas por retorno hoy</p>
                                <p class="lead text-center">
                                    {{ '$ ' . number_format($paid_dol, 2, '.', ',') }}
                                </p>
                            </div>
                        </a>
                    </li>
                    <li class="glide__slide">
                        <a href="#" class="card">
                            <div class="card-body text-center">
                                <i class="iconsminds-safe-box"></i>
                                <p class="card-text mb-0">Salidas pendientes</p>
                                <p class="lead text-center">{{ '$ ' . number_format($paid_pending_dol, 2, '.', ',') }}</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>


<div class="col-md-6 col-sm-12 mb-4">
    <div class="card dashboard-filled-line-chart">
        <div class="card-body ">
            <div class="float-left float-none-xs">
                <div class="d-inline-block">
                    <h5 class="d-inline">Inversiones en Soles (S/)</h5>
                    <span class="text-muted text-small d-block">Inversiones en la semana</span>
                </div>
            </div>
        </div>
        <div id="data-days" hidden>
            {{ json_encode($this->allWeek(['completed', 'active'], 1)['dates']) }}
        </div>
        <div id="data-amount" hidden>
            {{ json_encode($this->allWeek(['completed', 'active'], 1)["amount"]) }}
        </div>
        <div class="chart card-body pt-0">
            <canvas id="charPEN"></canvas>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12 mb-4">
    <div class="card dashboard-filled-line-chart">
        <div class="card-body ">
            <div class="float-left float-none-xs">
                <div class="d-inline-block">
                    <h5 class="d-inline">Inversiones en Dolares ($)</h5>
                    <span class="text-muted text-small d-block">Inversiones en la semana</span>
                </div>
            </div>
        </div>
        <div id="data-days-dollar" hidden>
            {{ json_encode($this->allWeek(['completed', 'active'], 2)['dates']) }}
        </div>
        <div id="data-amount-dollar" hidden>
            {{ json_encode($this->allWeek(['completed', 'active'], 2)["amount"]) }}
        </div>
        <div class="chart card-body pt-0">
            <canvas id="charDOLLAR"></canvas>
        </div>
    </div>
</div>
