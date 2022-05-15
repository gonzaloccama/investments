@if(!in_array($investment->status, ['active', 'completed']))
    <div class="position-absolute card-top-buttons">
        <button class="btn btn-outline-success icon-button"
                wire:click.prevent="saveEdit">
            <i class="fe-save"></i>
        </button>
    </div>
@endif

<h5 class="card-title">Editar Inversión</h5>
<table class="table">
    <tr>
        <th class="text-theme-1">Codigo:</th>
        <td>{{ $code }}</td>
    </tr>
{{--    <tr>--}}
{{--        <th class="text-theme-1">Modeda:</th>--}}
{{--        <td>--}}
{{--            <?php--}}
{{--            $options = \App\Models\Currency::select('currencies.*')--}}
{{--                ->selectRaw('CONCAT("(", symbol,")"," ", currency) as currency')->get();--}}
{{--            ?>--}}
{{--            <select class="form-control" id="currency" wire:model="currency">--}}
{{--                @foreach($options as $option)--}}
{{--                    <option value="{{ $option->id }}">{{ $option->currency }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--            @include('livewire.widgets.admin.form.error', ['name' => 'currency'])--}}
{{--        </td>--}}
{{--    </tr>--}}
    <tr>
        <th class="text-theme-1">Meses:</th>
        <td>
            <input type="text" class="form-control" id="period" wire:model="period">
            @include('livewire.widgets.admin.form.error', ['name' => 'period'])
        </td>
    </tr>
    <tr>
        <th class="text-theme-1">Plan:</th>
        <td>
            <?php
            $options = \App\Models\Plan::select('plans.*')
                ->selectRaw('CONCAT(name," (",percent,"%)") as plan')->get();
            ?>
            <select class="form-control" id="plan" wire:model="plan">
                @foreach($options as $option)
                    <option value="{{ $option->id }}">{{ $option->plan }}</option>
                @endforeach
            </select>
            @include('livewire.widgets.admin.form.error', ['name' => 'plan'])
        </td>
    </tr>
    <tr>
        <th class="text-theme-1">Fecha de Inicio:</th>
        <td>
            <input type="text" class="form-control" id="start_date" wire:model="start_date">
            @include('livewire.widgets.admin.form.error', ['name' => 'start_date'])
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
        <th class="text-theme-1">Estado:</th>
        <td>
            <span class="rounded-0 badge badge-{{  $investment->status }}">
               {{ $_status[ $investment->status] }}
            </span>
        </td>
    </tr>
</table>
