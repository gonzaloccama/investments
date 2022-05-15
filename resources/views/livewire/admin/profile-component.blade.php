<div class="row">
    <div class="col-md-12">
        <?php
        $buttons = ['is_add' => null]; // button add
        $mode = 'list'; // icon list or box

        $actions = [ //static actions table
            'view' => null,
            'show' => 'Ver aportes',
            'edit' => null,
            'go' => null,
            'delete' => 'Eliminar',
        ];

        /*** status custom ***/
        //        $_statusIndex = [
        //            'Sin aportes',
        //            'Con aportes',
        //        ];

        //        $filters = $roles;//filters

        //        $customs = [ // custom action table
        /** one button **/
        //            'button' => 'Ver Aportes',
        //            'action' => 'show',
        /** dropdown **/
        //                    'txt' => 'Estado', //static
        //                    'actions' => [ //editable
        //                        'delivered' => 'updateOrderStatus',
        //                        'completed' => 'updateOrderStatus',
        //                        'canceled' => 'updateOrderStatus',
        //                    ],
        //                    'inputs' => [ //static
        //                        'one' => 'id',
        //                        'two' => 'status',
        //                    ],
        //        ];
        ?>

        @include('livewire.widgets.admin.header.title-page')
    </div>
    @if($frame)
        @include('livewire.admin.profile.'.$frame)
    @endif

    {{--    @if($modal)--}}
    {{--        @include('livewire.admin.dashboard-component.'.$modal)--}}
    {{--    @endif--}}
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}"/>

    <style>

        .__scroller::-webkit-scrollbar {
            border-radius: 10px;
            width: 5px;
            height: 5px;
            background-color: #ddd;
        }

        .__scroller::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            /*background-color: rgba(221, 221, 221, 0.65);*/
            border-radius: 10px;
        }

        .__scroller::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background-color: #38688b;
        }

        .btn-header-warning {
            color: #f38d49;
            border-color: transparent;
            background: transparent;
            margin-top: -8px;
            margin-right: -8px;
        }

        .btn-header-warning:hover {
            background-color: transparent;
            border-color: rgba(243, 141, 73, 0.75);
            color: rgba(243, 141, 73, 0.75);
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/plugins/flatpickr/es.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/select2.full.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            activeSelect2('#gender', 'gender');
            activeSelect2('#relationship', 'relationship');
            activeSelect2('#region', 'region');
            activeSelect2('#province', 'province');

            activeFlatpickr('#birthdate');

            window.livewire.on('refreshContent', () => {
                activeSelect2('#gender', 'gender');
                activeSelect2('#relationship', 'relationship');
                activeSelect2('#region', 'region');
                activeSelect2('#province', 'province');
            });

            window.livewire.on('notification', (mssg) => {
                notificationSwal(`¡${mssg[0]}!`, 'rgba(0,67,124,0.76)');
                Livewire.emit('refresh');
            });

            window.livewire.on('onlyRefresh', () => {
                Livewire.emit('refresh');
            });

            window.livewire.on('showModal', () => {
                $('#showModal').modal('show');
            });

            window.livewire.on('deleteAlert', () => {
                deleteSwal();
            });

            window.livewire.on('deleteCustom', () => {
                deleteCustom();
            });

        });


        function activeSelect2(sel, varModel) {
            $(sel).select2({
                theme: "material",
                // dir: direction,
                placeholder: "Seleccione...",
                maximumSelectionSize: 6,
                containerCssClass: ":all:"
            });
            $(sel).on('change', function (e) {
                @this.
                set(varModel, e.target.value);
            });
        }

        function activeFlatpickr(sel, is_time = 0) {
            $(sel).flatpickr({
                enableTime: !!is_time,
                dateFormat: `${is_time ? 'Y-m-d H:i' : 'Y-m-d'}`,
                disableMobile: "true",
                "locale": "es"
            });
        }
    </script>
@endpush

