<div class="text-right">
    <div wire:loading wire:target="attachment">
        <button type="submit" class="btn btn-secondary btn-sm ml-auto text-white" disabled>
            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardando...</b>
        </button>
    </div>

    <div wire:loading wire:target="saveInPaint">
        <button type="submit" class="btn btn-secondary btn-sm ml-auto text-white" disabled>
            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardando...</b>
        </button>
    </div>

    <div wire:loading.remove>
        <button type="submit" class="btn btn-secondary btn-sm ml-auto"
                wire:click.prevent="saveInPaint">
            <b><i class="iconsminds-save"></i>&nbsp;&nbsp;Guardar</b>
        </button>
    </div>
</div>
