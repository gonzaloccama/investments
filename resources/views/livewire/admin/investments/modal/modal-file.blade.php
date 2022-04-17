<div wire:ignore.self class="modal fade" id="showModal" role="dialog"
     aria-labelledby="showModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Evidencia
                </h5>
                <button type="button" wire:click="closeFile" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <img src="{{ asset('assets/uploads/investment//') . '/' . $showFile->attachment }}"
                     alt="{{ $showFile->attachment }}" width="100%">

                <div class="container">
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <h3 class="text-theme-1">Monto: </h3>
                            <p>{{ $showFile->amount }}</p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-theme-1">Invesionista: </h3>
                            <p>{{ $showFile->user->fullname }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeFile" class="btn btn-outline-primary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>


