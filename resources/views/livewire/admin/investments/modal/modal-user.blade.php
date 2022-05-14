<div wire:ignore.self class="modal fade" id="showModal" role="dialog"
     aria-labelledby="showModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Nuevo Inversionista
                </h5>
                <button type="button" wire:click="closeAddUser" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @livewire('admin.add-user-component', [],  key(1))
            </div>
{{--            <div class="modal-footer">--}}
{{--                <button type="button" wire:click="closeFile" class="btn btn-outline-primary" data-dismiss="modal">--}}
{{--                    Cerrar--}}
{{--                </button>--}}
{{--            </div>--}}
        </div>
    </div>
</div>
