<div class="card p-4 border shadow-none rounded-0">
    <h5 class="card-title text-muted pt-0 mt-0 mb-4 title-nowrap">
        {{ __('Identificación') }}
    </h5>
    <?php
    $dt = [
        'name' => 'username',
        'text' => 'Nombre de usuario',
        'required' => 1,
        'readonly' => 1,
        'type' => 'text',
    ];
    ?>
    @include('livewire.widgets.admin.form.input-h', $dt)

    <?php
    $dt = [
        'name' => 'email',
        'text' => 'Correo electrónico',
        'required' => 1,
        'readonly' => 1,
        'type' => 'text',
    ];
    ?>
    @include('livewire.widgets.admin.form.input-h', $dt)

    <?php
    $dt = [
        'name' => 'dni',
        'text' => 'DNI',
        'required' => 1,
        'readonly' => 1,
        'type' => 'text',
    ];
    ?>
    @include('livewire.widgets.admin.form.input-h', $dt)
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card p-4 border shadow-none rounded-0 mt-3">
            <h5 class="card-title text-muted pt-0 mt-0 mb-4 title-nowrap">
                {{ __('Personal') }}
            </h5>
            <?php
            $dt = [
                'name' => 'firstname',
                'text' => 'Nombres',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'lastname',
                'text' => 'Apellidos',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'gender',
                'text' => 'Genero',
                'required' => 0,
                'object' => 'gender',
                'options' => \App\Models\Gender::all(),
            ];
            ?>
            @include('livewire.widgets.admin.form.select-h', $dt)

            <?php
            $dt = [
                'name' => 'birthdate',
                'text' => 'Cumpleaños',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'relationship',
                'text' => 'Estado civil',
                'required' => 0,
                'object' => 'relationship',
                'options' => \App\Models\Relationship::all(),
            ];
            ?>
            @include('livewire.widgets.admin.form.select-h', $dt)

            <?php
            $dt = [
                'name' => 'job',
                'text' => 'Ocupación',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 border shadow-none rounded-0 mt-3">
            <h5 class="card-title text-muted pt-0 mt-0 mb-4 title-nowrap">
                {{ __('Contacto') }}
            </h5>
            <?php
            $dt = [
                'name' => 'mobile',
                'text' => 'Celular',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'address',
                'text' => 'Dirección',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'country',
                'text' => 'Pais',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'region',
                'text' => 'Región',
                'required' => 0,
                'object' => 'region',
                'options' => \App\Models\Region::all(),
            ];
            ?>
            @include('livewire.widgets.admin.form.select-h', $dt)

            <?php
            $provinces = [];
            if ($region) {
                $provinces = json_decode(\App\Models\Region::find($region)->province);
            }

            $dt = [
                'name' => 'province',
                'text' => 'Provincia',
                'required' => 0,
                'object' => null,
                'options' => $provinces,
            ];
            ?>
            @include('livewire.widgets.admin.form.select-h', $dt)


            <?php
            $dt = [
                'name' => 'city',
                'text' => 'Ciudad',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="text-right">
            <div wire:loading wire:target="saveData">
                <button type="submit" class="btn btn-outline-secondary btn-sm text-white" disabled>
                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardando...</b>
                </button>
            </div>
            <div wire:loading.remove>
                <button type="submit" class="btn btn-secondary btn-sm"
                        wire:click.prevent="saveData">
                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
                </button>
            </div>
        </div>
    </div>
</div>
