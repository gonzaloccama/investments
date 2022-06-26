<div class="col-md-12">
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
                {{ $_user->fullname ?? __('Nuevo Inversión') }}
            </h5>
            <div class="separator mb-5"></div>

            <div class="row mb-5">
                <div class="col-md-7 ">
                    <div class="card border">
                        <div class="card-body">

                            <h5 class="card-title">Crear Inversión</h5>
                            <div class="separator mb-3 mt-3"></div>
                            <form action="">
                                {{--                                <?php--}}
                                {{--                                $dt = [--}}
                                {{--                                    'name' => 'currency',--}}
                                {{--                                    'text' => 'Nominación',--}}
                                {{--                                    'required' => 1,--}}
                                {{--                                    'object' => 'currency',--}}
                                {{--                                    'options' => \App\Models\Currency::select('currencies.*')--}}
                                {{--                                        ->selectRaw('CONCAT("(", symbol,")"," ", currency) as currency')->get(),--}}
                                {{--                                ];--}}
                                {{--                                ?>--}}
                                {{--                                @include('livewire.widgets.admin.form.select-h', $dt)--}}

                                <?php
                                $dt = [
                                    'name' => 'plan',
                                    'text' => 'Plan',
                                    'required' => 1,
                                    'object' => 'plan',
                                    'options' => \App\Models\Plan::select('plans.*')
                                        ->selectRaw('CONCAT(name," (",percent,"%)") as plan')->get(),
                                ];
                                ?>
                                @include('livewire.widgets.admin.form.select-h', $dt)

                                <?php
                                $_times = [
                                    'Years' => 'años',
                                    'Quarters' => 'trimestre',
                                    'Months' => 'meses',
                                    'Weeks' => 'semanas',
                                    'Days' => 'dias',
                                    'Hours' => 'horas',
                                ];

                                $_plan = 'Cantidad';
                                if ($plan) {
                                    $_plan .= ' de ' . $_times[\App\Models\Plan::find($plan)->time->duration];
                                }
                                ?>

                                <?php
                                $dt = [
                                    'name' => 'period',
                                    'text' => $_plan,
                                    'required' => 1,
                                    'type' => 'text',
                                ];
                                ?>
                                @include('livewire.widgets.admin.form.input-h', $dt)

                                <?php
                                $dt = [
                                    'name' => 'start_date',
                                    'text' => 'Inicio',
                                    'required' => 1,
                                    'type' => 'text',
                                ];
                                ?>
                                @include('livewire.widgets.admin.form.input-h', $dt)

                                <?php
                                $dt = [
                                    'name' => 'end_date',
                                    'text' => 'Fin',
                                    'required' => 1,
                                    'type' => 'text',
                                ];
                                ?>
                                @include('livewire.widgets.admin.form.input-h', $dt)

                                @if(in_array(auth()->user()->group, [1,2]))
                                    <?php
                                    $dt = [
                                        'name' => 'office_id',
                                        'text' => 'Oficina',
                                        'required' => 1,
                                        'object' => 'office',
                                        'options' => \App\Models\Office::all(),
                                    ];
                                    ?>
                                    @include('livewire.widgets.admin.form.select-h', $dt)
                                @endif

                            </form>
                            <div class="separator mb-4 mt-4"></div>
                            <div class="text-right">

                                <button type="submit" class="btn btn-secondary btn-sm"
                                        wire:click.prevent="saveData">
                                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-5 ">
                    <div class="card border">
                        <div class="card-body">
                            @include('livewire.admin.investments.details.user', ['dt' => $_user])
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


