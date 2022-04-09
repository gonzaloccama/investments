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
                {{ $name ?? __('Actualizar moneda') }}
            </h5>
            <div class="separator mb-5"></div>

            <?php
            $dt = [
                'name' => 'currency',
                'text' => 'Nominación de la moneda',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'symbol',
                'text' => 'Simbolo (ejm. $)',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <?php
            $dt = [
                'name' => 'code',
                'text' => 'Código (ejm. USD)',
                'required' => 1,
                'type' => 'text',
            ];
            ?>
            @include('livewire.widgets.admin.form.input-h', $dt)

            <div class="separator mb-5 mt-5"></div>

            <div class="text-right">
                <button class="btn btn-secondary btn-sm"
                        wire:click.prevent="closeFrame">
                    <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                </button>

                <button class="btn btn-danger btn-sm" wire:click.prevent="deleteConfirm({{ $itemId }})">
                    <b><i class="iconsminds-delete-file"></i>&nbsp;&nbsp;Eliminar</b>
                </button>

                <button type="submit" class="btn btn-secondary btn-sm"
                        wire:click.prevent="updateData">
                    <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar cambios</b>
                </button>

            </div>
        </div>
    </div>
</div>

