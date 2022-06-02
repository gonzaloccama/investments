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
                {{ $name ?? __('Nuevo Plan') }}
            </h5>
            <div class="separator mb-5"></div>

            <?php
            $dt = [
                'name' => 'name',
                'text' => 'Periordo de retorno',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'duration',
                'text' => 'Duración',
                'required' => 1,
                'object' => 'array',
                'options' => [
                ['id' => 'Years', 'name' => 'Años'],
                    ['id' => 'Quarters', 'name' => 'Trimestres'],
                    ['id' => 'Months', 'name' => 'Mes'],
                    ['id' => 'Weeks', 'name' => 'Semanas'],
                    ['id' => 'Days', 'name' => 'Días'],
                    ['id' => 'Hours', 'name' => 'Horas'],
                ],
            ];
            ?>
            @include('livewire.widgets.admin.form.select-h', $dt)

{{--            <?php--}}
{{--            $dt = [--}}
{{--                'name' => 'propagate',--}}
{{--                'text' => 'Propagar',--}}
{{--                'required' => 0,--}}
{{--                'type' => 'text',--}}
{{--            ];--}}
{{--            ?>--}}
{{--            @include('livewire.widgets.admin.form.input-h', $dt)--}}

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
