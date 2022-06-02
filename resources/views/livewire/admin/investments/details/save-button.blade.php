<div class="text-right">

    <div wire:loading wire:target="saveInPaint, attachment">
        <button type="submit" class="btn btn-secondary btn-sm ml-auto text-white" disabled>
            <b>
                <div class="spinner-grow text-light spinner-grow-sm" role="status"></div>
                Guardando...
            </b>
        </button>
    </div>

    <div wire:loading.remove wire:target="saveInPaint, attachment">
        <button type="submit" class="btn btn-secondary btn-sm ml-auto"
                wire:click.prevent="saveInPaint">
            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
        </button>
    </div>
</div>
