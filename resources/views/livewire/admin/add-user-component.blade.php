<div>
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
        <button type="submit" class="btn btn-secondary btn-xs" wire:click.prevent="saveData">
            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
        </button>
    </div>
</div>


{{--@push('scripts')--}}
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function () {--}}

{{--            window.livewire.on('refreshContent', () => {--}}
{{--                activeSelect2('#gender', 'gender');--}}
{{--                activeSelect2('#relationship', 'relationship');--}}
{{--                activeSelect2('#region', 'region');--}}
{{--                activeSelect2('#province', 'province');--}}
{{--            });--}}
{{--        });--}}



{{--        function activeSelect2(sel, varModel) {--}}
{{--            $(sel).select2({--}}
{{--                theme: "material",--}}
{{--                // dir: direction,--}}
{{--                placeholder: "Seleccione...",--}}
{{--                maximumSelectionSize: 6,--}}
{{--                containerCssClass: ":all:",--}}
{{--                templateResult: formatOption,--}}
{{--            });--}}
{{--            $(sel).on('change', function (e) {--}}
{{--                @this.--}}
{{--                set(varModel, e.target.value);--}}
{{--            });--}}

{{--            function formatOption(option) {--}}
{{--                var $option = $(--}}
{{--                    '<strong>' + option.text + '</strong>'--}}
{{--                );--}}
{{--                return $option;--}}
{{--            }--}}
{{--        }--}}

{{--        function activeFlatpickr(sel, is_time = 0) {--}}
{{--            $(sel).flatpickr({--}}
{{--                enableTime: !!is_time,--}}
{{--                dateFormat: `${is_time ? 'Y-m-d H:i' : 'Y-m-d'}`,--}}
{{--                disableMobile: "true",--}}
{{--                "locale": "es"--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}
