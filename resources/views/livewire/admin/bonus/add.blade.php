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
                {{ __('Nuevo Bonus') }}
            </h5>
            <div class="separator mb-5"></div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card border">
                        <div class="card-body">
                            <?php
                            $dt = [
                                'name' => 'type',
                                'text' => 'tipo de bonus',
                                'required' => 1,
                                'object' => 'array',
                                'options' => [
                                    ['id' => 'referred', 'name' => 'Referido'],
                                    ['id' => 'invest', 'name' => 'Inversión 30K'],
                                    ['id' => 'reself', 'name' => 'Refersirse a si mismo'],
                                ],
                            ];
                            ?>
                            @include('livewire.widgets.admin.form.select-h', $dt)

                            <?php
                            $dt = [
                                'name' => 'investment_id',
                                'text' => 'Inversión',
                                'required' => 1,
                                'object' => 'code',
                                'options' => \App\Models\Investment::whereIn('status', ['active'])
                                    ->whereDate('end_date', '>', \Carbon\Carbon::today())
                                    ->get(),
                            ];
                            ?>
                            @include('livewire.widgets.admin.form.select-h', $dt)

                            @if($type && $type == 'referred')
                                <?php
                                $dt = [
                                    'name' => 'referred_to',
                                    'text' => 'DNI del referido',
                                    'required' => 1,
                                    'type' => 'text',
                                ];
                                ?>
                                @include('livewire.widgets.admin.form.input-h', $dt)
                            @endif

                            <?php
                            $dt = [
                                'name' => 'percent',
                                'text' => 'Porcentaje',
                                'required' => 1,
                                'type' => 'text',
                            ];
                            ?>
                            @include('livewire.widgets.admin.form.input-h', $dt)

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @if(isset($investment) && !empty($investment))
                        <div class="card border">
                            <div class="card-body">
                                <?php
                                $img = $investment->user->gender == 2 ? 'woman.svg' : 'man.svg';
                                $profile = $investment->user->picture ? $investment->user->picture : $img;
                                ?>
                                <div class="text-center mt-3">
                                    <img alt="{{ $investment->user->fullname }}"
                                         src="{{ asset('assets/img/avatar/').'/' . $profile }}"
                                         class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail">
                                    <p class="list-item-heading mb-1">{{ $investment->user->fullname }}</p>
                                    <p class="mb-4 text-muted text-small">DNI: {{ $investment->user->dni }}</p>
                                </div>

                                <p class="text-muted text-small mb-2">Celular</p>
                                <p class="mb-3">{{ $investment->user->mobile }}</p>

                                <p class="text-muted text-small mb-2">Capital de inversión</p>
                                <p class="mb-3">
                                    {{ $investment->isCurrency->symbol . ' ' . number_format($investment->amount, 2, '.', ',') }}
                                </p>

                                <p class="text-muted text-small mb-2">Periodo actual</p>
                                <p class="mb-3">{{ $investment->current_period . ' de ' . $investment->period }}</p>

                                <p class="text-muted text-small mb-2">Fecha de inicio</p>
                                <p class="mb-3">
                                    <?php
                                    echo ucfirst(Carbon\Carbon::parse($investment->start_date)
                                        ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
                                    ?>
                                </p>

                                <p class="text-muted text-small mb-2">Fecha de culminación</p>
                                <p class="mb-3">
                                    <?php
                                    echo ucfirst(Carbon\Carbon::parse($investment->end_date)
                                        ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y'));
                                    ?>
                                </p>

                                <p class="text-muted text-small mb-2">Progreso</p>
                                <p class="mb-3">
                                    {{ __('Faltan: ') . intdiv($investment->remaining_hours, 24) . ' días, ' . ($investment->remaining_hours % 24) . ' horas' }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="separator mb-5 mt-5"></div>

            <div class="text-right">
                <button class="btn btn-secondary btn-sm"
                        wire:click.prevent="closeFrame">
                    <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                </button>

                <button type="submit" class="btn btn-secondary btn-sm"
                        wire:click.prevent="saveData">
                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
                </button>
            </div>
        </div>
    </div>
</div>
