<div>
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card border rounded-0 shadow-none p-3">
                <?php
                $dt = [
                    'name' => 'dni',
                    'text' => 'DNI',
                    'required' => 1,
                    'function' => 'searchData'
                ];
                ?>
                @include('livewire.widgets.admin.form.input-button-h', $dt)


                <?php
                $dt = [
                    'name' => 'firstname',
                    'text' => 'Nombres',
                    'required' => 1,
                    'type' => 'text',
                    'readonly' => $disable_read,
                ];
                ?>
                @include('livewire.widgets.admin.form.input-h', $dt)

                <?php
                $dt = [
                    'name' => 'lastname',
                    'text' => 'Apellidos',
                    'required' => 1,
                    'type' => 'text',
                    'readonly' => $disable_read,
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
        <div class="col-md-6 col-12 mt-md-0 mt-3">
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

    <div class="text-right mt-3">

        <div wire:loading wire:target="saveData">
            <button type="submit" class="btn btn-secondary text-white" disabled>
                <b>
                    <div class="spinner-grow text-light spinner-grow-sm" role="status"></div>
                    Guardando...
                </b>
            </button>
        </div>

        <div wire:loading.remove wire:target="saveData">
            <button type="submit" class="btn btn-secondary" wire:click.prevent="saveData">
                <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
            </button>
        </div>
    </div>

    <script type="text/javascript">
        console.log("Child loaded.");
        initField();

        activeFlatpickr('#birthdate');

        window.addEventListener('childRefresh', event => {
            initField();
        });

        function initField() {
            initSelect2('#gender', 'gender');
            initSelect2('#relationship', 'relationship');
            initSelect2('#region', 'region');
            initSelect2('#province', 'province');
        }

        function initSelect2(sel, varModel) {
            if ($().select2) {
                $(sel).select2({
                    theme: "material",
                    // dir: direction,
                    placeholder: "Seleccione...",
                    maximumSelectionSize: 6,
                    containerCssClass: ":all:",
                    "language": {
                        "noResults": function () {
                            return "No se han encontrado resultados";
                        }
                    },
                });
                $(sel).on('change', function (e) {
                    @this.
                    set(varModel, $(this).val());
                });
            }

            function formatOption(option) {
                var $option = $(
                    '<strong>' + option.text + '</strong>'
                );
                return $option;
            }
        }
    </script>
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


{{--        --}}{{--function activeSelect2(sel, varModel) {--}}
{{--        --}}{{--    $(sel).select2({--}}
{{--        --}}{{--        theme: "material",--}}
{{--        --}}{{--        // dir: direction,--}}
{{--        --}}{{--        placeholder: "Seleccione...",--}}
{{--        --}}{{--        maximumSelectionSize: 6,--}}
{{--        --}}{{--        containerCssClass: ":all:",--}}
{{--        --}}{{--        templateResult: formatOption,--}}
{{--        --}}{{--    });--}}
{{--        --}}{{--    $(sel).on('change', function (e) {--}}
{{--        --}}{{--        @this.--}}
{{--        --}}{{--        set(varModel, e.target.value);--}}
{{--        --}}{{--    });--}}

{{--        --}}{{--    function formatOption(option) {--}}
{{--        --}}{{--        var $option = $(--}}
{{--        --}}{{--            '<strong>' + option.text + '</strong>'--}}
{{--        --}}{{--        );--}}
{{--        --}}{{--        return $option;--}}
{{--        --}}{{--    }--}}
{{--        --}}{{--}--}}

{{--        --}}{{--function activeFlatpickr(sel, is_time = 0) {--}}
{{--        --}}{{--    $(sel).flatpickr({--}}
{{--        --}}{{--        enableTime: !!is_time,--}}
{{--        --}}{{--        dateFormat: `${is_time ? 'Y-m-d H:i' : 'Y-m-d'}`,--}}
{{--        --}}{{--        disableMobile: "true",--}}
{{--        --}}{{--        "locale": "es"--}}
{{--        --}}{{--    });--}}
{{--        --}}{{--}--}}
{{--    </script>--}}
{{--@endpush--}}
