@if(isset($name) && !empty($name))

    <div class="form-group row">
        <label for="{{ $name }}"
               class="col-sm-3 col-form-label">{{ $text }} {!! $required ? '<i class="text-danger">*</i>':'' !!}</label>
        <div class="col-sm-9">
            <div class="input-group mb-1">
                <input type="{{ $type }}" class="form-control" aria-label="{{ $name }}" id="{{ $name }}"
                       placeholder="{{ $text }}" wire:model="{{ $name }}" aria-describedby="{{ $name }}-1">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="button"
                            wire:click.prevent="addInput({{$iterator}})" id="{{ $name }}-1">
                        <b><i class="iconsminds-add"></i> Nuevo</b>
                    </button>
                </div>
            </div>
            @include('livewire.widgets.admin.form.error')
        </div>

    </div>
@endif
