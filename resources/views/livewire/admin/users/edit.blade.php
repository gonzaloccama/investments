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
                {{ $firstname || $lastname ? $firstname . ' ' . $lastname : __('Actualizar usuario') }}
            </h5>
            <div class="separator mb-5"></div>


            <div class="row">
                <div class="col-md-6">
                    <div class="card border rounded-0 shadow-none p-3">
                        <?php
                        $dt = [
                            'name' => 'dni',
                            'text' => 'DNI',
                            'required' => 1,
                            'type' => 'text',
                        ];
                        ?>
                        @include('livewire.widgets.admin.form.input-h', $dt)

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
                    <div class="card border rounded-0 shadow-none p-3">
                        <?php
                        $dt = [
                            'name' => 'email',
                            'text' => 'Correo',
                            'required' => 1,
                            'type' => 'text',
                        ];
                        ?>
                        @include('livewire.widgets.admin.form.input-h', $dt)

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
            </div>

            <div class="separator mb-5 mt-5"></div>

            <div class="text-right">
                <button class="btn btn-secondary btn-sm"
                        wire:click.prevent="closeFrame">
                    <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                </button>

                <button class="btn btn-danger btn-sm" wire:click.prevent="deleteConfirm({{ $itemId }})">
                    <b><i class="simple-icon-user-unfollow"></i>&nbsp;&nbsp;Eliminar</b>
                </button>

                <button type="submit" class="btn btn-secondary btn-sm"
                        wire:click.prevent="updateData">
                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>
                </button>

            </div>
        </div>
    </div>
</div>
