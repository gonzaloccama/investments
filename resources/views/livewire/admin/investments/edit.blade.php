<div class="col-md-12">
    <div class="card border rounded-0">
        <div class="position-absolute card-top-buttons">
            <button class="btn btn-header-light icon-button" wire:click.prevent="closeFrame">
            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
            </button>
        </div>

        <div class="card-body">
            <h5 class="card-title text-muted text-uppercase pt-0 mt-0 mb-4 title-nowrap">
                {{ $_user->fullname ?? __('Nuevo Inversión') }}
            </h5>
            <div class="separator mb-5"></div>

            <div class="row">
                <div class="col-12">
                    <div class="row icon-cards-row mb-4 sortable">
                        <div class="col-md-3 col-lg-3 col-sm-4 col-6 mb-2">
                            <a href="#" class="card border">
                                <div class="card-body text-center">
                                    <i class="iconsminds-wallet"></i>
                                    <p class="card-text font-weight-semibold mb-0">Inversión</p>
                                    <p class="lead text-center">
                                        {{ $investment->isCurrency->symbol . ' ' . number_format($investment->amount, 2, '.', ',') }}
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 col-lg-3 col-sm-4 col-6 mb-2">
                            <a href="#" class="card border">
                                <div class="card-body text-center">
                                    <i class="iconsminds-financial"></i>
                                    <p class="card-text font-weight-semibold mb-0">Retorno Mensual</p>
                                    <p class="lead text-center">
                                        {{ $investment->isCurrency->symbol . ' ' . number_format($investment->return_amount, 2, '.', ',') }}
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 col-lg-3 col-sm-4 col-6 mb-2">
                            <a href="#" class="card border">
                                <div class="card-body text-center">
                                    <i class="iconsminds-coins"></i>
                                    <p class="card-text font-weight-semibold mb-0">Retorno
                                        x {{ $investment->period }}</p>
                                    <p class="lead text-center">
                                        {{ $investment->isCurrency->symbol . ' ' . number_format($investment->return_amount * $investment->period, 2, '.', ',') }}
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 col-lg-3 col-sm-4 col-6 mb-2">
                            <a href="#" class="card border">
                                <div class="card-body text-center">
                                    <i class="iconsminds-calendar-4"></i>
                                    <p class="card-text font-weight-semibold mb-0">Días restantes</p>
                                    <p class="lead text-center">
                                        {{ $investment->status == 'active' ? $investment->remaining_days : 'Inactivo' }}
                                    </p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7 ">

                    <div class="card border">
                        <div class="card-body">
                            <div class="position-absolute card-top-buttons">
                                <button class="btn btn-secondary icon-button"
                                        wire:click.prevent="updatePutContribution('cash')">
                                    <i class="fe-edit"></i>
                                </button>
                            </div>
                            <h5 class="card-title">Detalles de la Inversión</h5>
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
                                    <td>{{ $period.' meses' }}</td>
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
                                        @if($investment->status == 'active')
                                            {{ __('Faltan: ') . $investment->remaining_days . ' días' }} <br>

                                            <?php
                                            $perc = $investment->percent;

                                            $prc = $perc > 97 ? '#317347' : '#0e5f05';
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
                            <div class="separator mb-4 mt-1"></div>

                        </div>
                    </div>
                </div>

                <div class="col-md-5 ">
                    @include('livewire.admin.investments.details.user', ['dt' => $_user])
                </div>
            </div>

            @if($paint)
                @include('livewire.admin.investments.details.' . $paint)
            @endif

            <div class="row mt-5">
                <div class="col-md-5">
                    <div class="card border">
                        <div class="card-body">
                            <div class="position-absolute card-top-buttons">
                                <button class="btn btn-secondary icon-button"
                                        wire:click.prevent="openPaint('cash')">
                                    <i class="fe-plus"></i>
                                </button>
                            </div>
                            <h5 class="card-title mb-0">Efectivo</h5>
                            <span class="text-small mt-0 font-italic">
                                Mostrando {{ $c = $investment->cashDeposit->count() }} {{ $c == 1 ? 'elemento' : 'elementos' }}
                            </span>
                            <div class="scrollbar scroller" style="height: 240px;">
                                <?php
                                $hdrs = [
                                    'id' => '#',
                                    'amount' => 'Monto',
                                    'attachment' => 'Eviden.',
                                    'created_at' => 'Fecha',
//                                    'not' => '',
                                ];
                                $show = 'cash';//Show Modal and delete
                                $dts = $investment->cashDeposit; //data show in table
                                $deletion = 'deleteCustomConfirm';
                                $isCurrency = $investment->isCurrency->symbol;
                                ?>
                                @include('livewire.widgets.admin.table.table-custom')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card border">
                        <div class="card-body">
                            <div class="position-absolute card-top-buttons">
                                <button class="btn btn-secondary icon-button"
                                        wire:click.prevent="openPaint('bank-transfer')">
                                    <i class="fe-plus"></i>
                                </button>
                            </div>
                            <h5 class="card-title mb-0">Transferencia bancaria</h5>
                            <span class="text-small mt-0 font-italic">
                                Mostrando {{ $c = $investment->bankTransfer->count() }} {{ $c == 1 ? 'elemento' : 'elementos' }}
                            </span>
                            <div class="scrollbar scroller" style="height: 240px;">
                                <?php
                                $hdrs = [
                                    'id' => '#',
                                    'bank_id' => 'Banco',
                                    'amount' => 'Monto',
                                    'attachment' => 'Evidencia',
                                    'created_at' => 'Fecha',
                                    'not' => '',
                                ];
                                $show = 'cash';//Show Modal and delete
                                $dts = $investment->bankTransfer; //data show in table
                                $deletion = 'deleteCustomConfirm';
                                ?>
                                @include('livewire.widgets.admin.table.table-custom')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="separator mb-5 mt-5"></div>

            <div class="text-right">
                <button class="btn btn-secondary btn-sm"
                        wire:click.prevent="closeFrame">
                    <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                </button>

                {{--                <button type="submit" class="btn btn-secondary btn-sm"--}}
                {{--                        wire:click.prevent="saveData">--}}
                {{--                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>--}}
                {{--                </button>--}}
            </div>
        </div>
    </div>
</div>


