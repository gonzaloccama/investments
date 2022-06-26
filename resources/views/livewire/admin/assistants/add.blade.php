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
            <h5 class="card-title text-muted text-uppercase pt-0 mt-0 mb-4 title-nowrap">{{ __('Nuevo encargado') }}</h5>
            <div class="separator mb-5"></div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card border">
                            <div class="card-body mt-3">
                                <?php
                                $dt = [
                                    'name' => 'itemId',
                                    'text' => 'Encargado',
                                    'required' => 1,
                                    'object' => 'fullname',
                                    'options' => $data,
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

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">

                            @if($itemId)
                                <?php
                                $user = App\Models\User::find($itemId);
                                ?>
                                @include('livewire.admin.administrators.details.user', ['dt' => $user])

                            @endif

                    </div>
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
