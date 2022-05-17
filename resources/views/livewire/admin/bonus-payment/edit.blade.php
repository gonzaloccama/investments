<div class="col-md-12">
    <?php
    $typeBonus = [ //
        'referred' => 'Referido',
        'invest' => 'Inversión 30K',
        'reself' => 'Referido a si mismo',
    ]
    ?>
    <div class="card border rounded-0">
        <div class="position-absolute card-top-buttons">
            <button class="btn btn-header-light icon-button" wire:click.prevent="closeFrame">
            <span style="color: #a0a0a0;position: absolute; margin-top: -17px; margin-left: -12px">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
            </button>
        </div>

        <div class="card-body">
            <h5 class="card-title text-muted text-uppercase pt-0 mt-0 mb-4 title-nowrap">
                {{ $payment->code . ' - Pago de: ' . $payment->type_payment }}
            </h5>
            <div class="separator mb-5"></div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="row icon-cards-row mb-4 sortable">
                        <div class="col-md-6 col-lg-3 col-sm-6 col-6 mb-2">
                            <a href="#" class="card border shadow">
                                <div class="card-body text-center">
                                    <i class="iconsminds-wallet"></i>
                                    <p class="card-text font-weight-semibold mb-0">Inversión</p>
                                    <p class="lead text-center font-22">
                                        {{ $payment->investment->isCurrency->symbol . ' ' . number_format($payment->investment->amount, 2, '.', ',') }}
                                    </p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6 col-lg-3 col-sm-6 col-6 mb-2">
                            <a href="#" class="card border">
                                <div class="card-body text-center">
                                    <i class="iconsminds-financial"></i>
                                    <p class="card-text font-weight-semibold mb-0">Pago Bonus
                                    </p>
                                    <p class="lead text-center font-22">
                                        {{ $payment->investment->isCurrency->symbol . ' ' . number_format($payment->amount, 2, '.', ',') }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-6 col-6 mb-2">
                            <a href="#" class="card border">
                                <div class="card-body text-center">
                                    <i class="simple-icon-calendar"></i>
                                    <p class="card-text font-weight-semibold mb-0">
                                        {{ $typeBonus[$payment->toBonus->type] }}
                                    </p>
                                    <p class="lead text-center font-22">
                                        {{ number_format($payment->toBonus->percent, 0, '.', ',') }}%
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3 col-sm-6 col-6 mb-2">
                            <a href="#" class="card border">
                                <div class="card-body text-center">
                                    <i class="iconsminds-calendar-4"></i>
                                    <p class="card-text font-weight-semibold mb-0">Estado</p>
                                    <p class="lead text-center font-22">
                                        @if($payment->status == 'waiting')
                                            <?php
                                            echo intdiv($payment->remaining_hours, 24) . ' días, ' . ($payment->remaining_hours % 24) . ' horas';
                                            ?>
                                        @else
                                            <span
                                                class="text-{{ $payment->status }}">{{ $_status[$payment->status] }}</span>
                                        @endif

                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $refer = \App\Models\User::where('dni', $payment->toBonus->referred_to)->get();
            ?>

            @if($payment->amount)

                @if(in_array($payment->status, ['pending']))
                    @if($refer->count() && $payment->toBonus->type == 'referred' || $payment->toBonus->type != 'referred')
                        <div class="text-right mb-5">
                            <a href="javascript:;" wire:click.prevent="updateData" class="btn btn-secondary btn-sm"
                               id="pending"
                               target="_blank"><b><i class="la la-money"></i>&nbsp;&nbsp;Pagar</b></a>
                        </div>
                    @endif
                @endif


                @if(in_array($payment->status, ['paid']) && $receipt = \App\Models\Admin\Receipt::where('payment_id',  $payment->id)->first())
                    <div class="text-right mb-5">
                        <a href="{{ asset('assets/uploads/receipts/') . '/' . $receipt->attachment }}"
                           class="btn btn-success btn-sm" id="paid"
                           target="_blank"><b><i class="la la-file"></i>&nbsp;&nbsp;Recibo</b></a>
                    </div>
                @endif

            @endif

            <div class="row">
                <div class="col-md-7">
                    <div class="card border">
                        <div class="card-body">
                            <h3 class="card-title">Detalles del pago</h3>

                            @if(!$refer->count())
                                <div class="alert alert-danger"><i class="fe-alert-triangle"></i> El referido por el
                                    usuario no está en nuestros registros
                                </div>
                            @endif

                            <table class="table">
                                <tr>
                                    <th class="text-theme-1">Inversión</th>
                                    <td>
                                        {{ $payment->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1">Capital de inversión</th>
                                    <td>
                                        {{ $payment->isCurrency->symbol . ' ' .number_format($payment->investment->amount, 2, '.', ',') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1">Porcentaje del Bonus</th>
                                    <td>
                                        {{ number_format($payment->toBonus->percent, 0, '.', ',') }}%
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1">Codigo del Bonus</th>
                                    <td>
                                        {{ $payment->toBonus->code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1">Recomendado</th>
                                    <td>
                                        DNI: {{ $payment->toBonus->referred_to }} <br>
                                        @if(!$refer->count())
                                            <div class="alert alert-danger mt-2"><i class="fe-alert-triangle"></i> El
                                                referido aun no se encuentra!
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1">Monto</th>
                                    <td>
                                        {{ $payment->isCurrency->symbol . ' ' . number_format($payment->amount, 2, '.', ',') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1">Tipo de pago</th>
                                    <td>
                                        {{ $typeBonus[$payment->toBonus->type] }}
                                    </td>
                                </tr>

                                <tr>
                                    <th class="text-theme-1">Fecha de pago</th>
                                    <td>
                                        <?php
                                        if ($payment->payment_date) {
                                            echo ucfirst(Carbon\Carbon::parse($payment->payment_date)
                                                ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
                                        } else {
                                            echo $_status[$payment->status];
                                        }
                                        ?>
                                    </td>


                                </tr>

                                <tr>
                                    <th class="text-theme-1">Estado</th>

                                    <td>
                                          <span class="rounded-0 badge badge-{{  $payment->status }}">
                                           {{ $_status[$payment->status] }}
                                        </span>
                                    </td>


                                </tr>


                            </table>
                        </div>
                    </div>
                </div>


                <div class="col-md-5 mt-4 mt-md-0">
                    <div class="card border">
                        <div class="card-body">
                            @include('livewire.admin.investments.details.user', ['dt' => $payment->investment->user])
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
