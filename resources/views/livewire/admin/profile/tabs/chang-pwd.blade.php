<div class="card p-4 border shadow-none rounded-0">
    <?php
    $dt = [
        'name' => 'current_password',
        'text' => 'Contraseña actual',
        'required' => 1,
        'type' => 'password',
    ];
    ?>
    @include('livewire.widgets.admin.form.input-h', $dt)

    <?php
    $dt = [
        'name' => 'password',
        'text' => 'Nueva contraseña',
        'required' => 1,
        'type' => 'password',
    ];
    ?>
    @include('livewire.widgets.admin.form.input-h', $dt)

    <?php
    $dt = [
        'name' => 'confirm_password',
        'text' => 'Confirmar contraseña',
        'required' => 1,
        'type' => 'password',
    ];
    ?>
    @include('livewire.widgets.admin.form.input-h', $dt)

</div>

<div class="text-right mt-4">
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
