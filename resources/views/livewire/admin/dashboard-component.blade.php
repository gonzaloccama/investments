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
        @include('livewire.admin.dashboard.'.$frame)
    @endif

{{--    @if($modal)--}}
{{--        @include('livewire.admin.dashboard-component.'.$modal)--}}
{{--    @endif--}}
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/select2-bootstrap.min.css') }}"/>
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/vendor/select2.full.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            window.livewire.on('refreshContent', () => {
                activeSelect2('#user_id', 'user_id');
                activeSelect2('#unit', 'unit');
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

        function deleteCustom() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary ml-3',
                    cancelButton: 'btn btn-danger mr-3',
                    popup: 'swal-modal-delete',
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Estas seguro?',
                text: "¡No podrás revertir esto esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminarlo!',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('customConfirm');

                    swalWithBootstrapButtons.fire(
                        '¡Eliminado!',
                        'El registro ha sido eliminado. <i class="far fa-dizzy text-danger"></i>',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        '¡Cancelado!',
                        'Tu registro está a salvo <i class="far fa-smile-beam text-primary"></i>',
                        'error'
                    )
                }
            })
        }

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
    </script>
@endpush
