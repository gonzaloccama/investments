<div class="row">
    <div class="col-md-12 mt-5">
        <div class="card border">
            <div class="card-body">
                <div class="position-absolute card-top-buttons">
                    <button class="btn btn-danger icon-button"
                            wire:click.prevent="closePaint">
                        <i class="fe-minus"></i>
                    </button>
                </div>
                <h5 class="card-title">Agregar en Efectivo</h5>

                <div class="row">
                    <div class="col-md-6">
                        <?php
                        $dt = [
                            'name' => '_amount',
                            'text' => 'Monto en (' . $investment->isCurrency->symbol . ')',
                            'required' => 1,
                            'type' => 'text',
                        ];
                        ?>
                        @include('livewire.widgets.admin.form.input-h', $dt)
                    </div>
                    <div class="col-md-6">


                        <?php
                        $dt = [
                            'name' => 'attachment',
                            'text' => 'Evidencia',
                            'required' => 1,
                            'type' => 'file',
                            'accept' => '',
                        ];
                        ?>
                        @include('livewire.widgets.admin.form.input-h', $dt)

                        <div class="form-group row">
                            <div class="offset-3 col-sm-9">
                                @if($attachment)
                                    <div class="mb-3">{{ $attachment->getClientOriginalName() }}</div>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 d-flex">
                        <button type="submit" class="btn btn-secondary btn-sm ml-auto"
                                wire:click.prevent="saveInPaint">
                            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
