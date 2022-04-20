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
                                    <p class="lead text-center font-22">
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
                                    <p class="lead text-center font-22">
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
                                    <p class="lead text-center font-22">
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
                                    <p class="lead text-center font-22">
                                        <?php
                                        if ($investment->status == 'active') {
                                            echo intdiv($investment->remaining_hours, 24) . ' días, ' . ($investment->remaining_hours % 24) . ' horas';
                                        } else {
                                            echo 'Inactivo';
                                        }
                                        ?>
                                    </p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            @if($investment->amount)
                <div class="text-right mb-5">

                    @if(in_array($investment->status, ['active', 'completed']))
                        @if($investment->end_date <= \Carbon\Carbon::today())
                            <a href="javascript:;" wire:click.prevent="" class="btn btn-success btn-sm"
                               target="_blank"><b><i class="fe-printer"></i>&nbsp;&nbsp;Reembolsar</b></a>
                        @else
                            <a href="javascript:;"
                               class="btn btn-danger btn-sm" target="_blank"><b><i class="iconsminds-delete-file"></i>&nbsp;&nbsp;Cancelar
                                    inversión</b></a>
                        @endif
                        <a href="{{ route('admin.upcoming-payments').'?investment=' . base64_encode($investment->id) }}"
                           class="btn btn-secondary btn-sm"><b><i class="fe-printer"></i>&nbsp;&nbsp;Pagos</b></a>

                        <a href="{{ route('contract.investments').'?id=' . base64_encode($investment->id) }}"
                           class="btn btn-secondary btn-sm" target="_blank"><b><i class="fe-printer"></i>&nbsp;&nbsp;Imprimir</b></a>
                    @else
                        <a href="javascript:;" wire:click.prevent="activeInvestment"
                           class="btn btn-secondary btn-sm"
                           target="_blank"><b><i class="fe-check"></i>&nbsp;&nbsp;Activar inversión</b></a>
                    @endif
                </div>
            @endif

            <div class="row">
                <div class="col-md-7 ">

                    <div class="card border">
                        <div class="card-body">

                            @if($update && $investment->status != "active")
                                @include('livewire.admin.investments.investment.update')
                            @else
                                @include('livewire.admin.investments.investment.show')
                            @endif

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
                            @if(!in_array($investment->status, ['active', 'completed']))
                                <div class="position-absolute card-top-buttons">
                                    <button class="btn btn-secondary icon-button"
                                            wire:click.prevent="openPaint('cash')">
                                        <i class="fe-plus"></i>
                                    </button>
                                </div>
                            @endif
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
                            @if(!in_array($investment->status, ['active', 'completed']))
                                <div class="position-absolute card-top-buttons">
                                    <button class="btn btn-secondary icon-button"
                                            wire:click.prevent="openPaint('bank-transfer')">
                                        <i class="fe-plus"></i>
                                    </button>
                                </div>
                            @endif
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
//                                    'not' => '',
                                ];
                                $show = 'bankTransfer';//Show Modal and delete
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


