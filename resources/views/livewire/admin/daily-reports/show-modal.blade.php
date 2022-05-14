<div wire:ignore.self class="modal fade" id="showModal" role="dialog"
     aria-labelledby="showModal" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Reporte: {{ ucfirst(Carbon\Carbon::parse($report->created_at)
                                            ->locale('es')->translatedFormat('l\, d \d\e F \d\e\l Y | g:i:s A')) }}
                </h5>
                <button type="button" wire:click="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <object data="{{ asset('assets/uploads/daily-reports/') . '/' . $report->attachment }}"
                        type="application/pdf" frameborder="0" width="100%" height="600px" style="padding: 20px;">
                    <embed src="{{ asset('assets/uploads/daily-reports/') . '/' . $report->attachment }}" width="100%"
                           height="600px"/>
                </object>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeModal" class="btn btn-outline-primary" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

