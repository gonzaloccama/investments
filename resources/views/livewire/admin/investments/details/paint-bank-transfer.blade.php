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
                <h5 class="card-title">Transferecia bancaria</h5>

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

                        <?php
                        $dt = [
                            'name' => 'attachment',
                            'text' => 'Evidencia',
                            'required' => 1,
                            'type' => 'file',
                            'accept' => 'image',
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
                    <div class="col-md-6">

                            <?php
                            $dt = [
                                'name' => 'bank_id',
                                'text' => 'Banco',
                                'required' => 1,
                                'object' => 'name',
                                'options' => \App\Models\Bank::all(),
                            ];
                            ?>
                            @include('livewire.widgets.admin.form.select-h', $dt)



                        <?php
                        $dt = [
                            'name' => 'transfer_date',
                            'text' => 'Fecha de transferencia',
                            'required' => 1,
                            'type' => 'text',
                        ];
                        ?>
                        @include('livewire.widgets.admin.form.input-h', $dt)

                        <?php
                        $dt = [
                            'name' => 'transfer_account',
                            'text' => 'N° de Cuenta Bancaria',
                            'required' => 1,
                            'type' => 'text',
                        ];
                        ?>
                        @include('livewire.widgets.admin.form.input-h', $dt)


                    </div>

                    <div class="col-md-12">
                        @include('livewire.admin.investments.details.save-button')
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

