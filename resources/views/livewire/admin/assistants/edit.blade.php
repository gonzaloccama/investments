<div class="col-md-12">
    <div class="card">
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
                {{ $data->fullname ? $data->fullname : __('Editar encargado') }}
            </h5>
            <div class="separator mb-5"></div>
            <div class="scroll">
                <div class="card-body border">

                    @include('livewire.admin.administrators.details.user', ['dt' => $data])

                    <?php
                    $dt = [
                        'name' => 'group',
                        'text' => 'Rol de usuario',
                        'required' => 1,
                        'object' => 'role',
                        'options' => \App\Models\Role::whereNotIn('id', [1])->get(),
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.select-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'office_id',
                        'text' => 'Oficina',
                        'required' => 0,
                        'object' => 'office',
                        'options' => $offices,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.select-h', $dt)

                    <?php
                    $dt = [
                        'name' => 'activated',
                        'text' => 'Cuenta activada',
                        'required' => 0,
                        'type' => 'checkbox',
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-h', $dt)

                    <div class="separator mb-5 mt-5"></div>

                    <div class="text-right">
                        <button class="btn btn-secondary btn-sm"
                                wire:click.prevent="closeFrame">
                            <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                        </button>

                        <button type="submit" class="btn btn-secondary btn-sm"
                                wire:click.prevent="updateData">
                            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
