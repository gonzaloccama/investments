@if(isset($name) && !empty($name))

    <div class="form-group row">
        <label for="{{ $name }}"
               class="col-sm-3 col-form-label">{{ $text }} {!! $required ? '<i class="text-danger">*</i>':'' !!}</label>
        <div class="col-sm-9 @error($name) error-validate @enderror">
            <div class="input-group mb-1" wire:ignore>
                <input type="text" class="form-control" aria-label="{{ $name }}" id="{{ $name }}"
                       placeholder="{{ $text }}" wire:model="{{ $name }}" aria-describedby="button-{{ $text }}">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button"
                            wire:click.prevent="{{ $function }}"
                            id="button-dni">
                        <b wire:loading.remove wire:target="{{ $function }}">Buscar...</b>
                        <b wire:loading wire:target="{{ $function }}">
                            <div class="spinner-grow text-light spinner-grow-sm" role="status"></div>
                        </b>
                    </button>
                </div>
            </div>
            @include('livewire.widgets.admin.form.error')
        </div>

    </div>
@endif
