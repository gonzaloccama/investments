@if(isset($name) && !empty($name))
    <div class="form-group row">
        <label for="{{ $name }}" class="col-md-3 col-form-label">{{ $text }}
            {!! $required?'<i class="text-danger">*</i>':'' !!}
        </label>
        <div class="col-9">
            <div wire:ignore>
                <textarea class="form-control scrollbar scroller" id="{{ $name }}" rows="5"
                          style="height: 60px; !important;"
                          wire:model="{{ $name }}" placeholder="{{ $text }}"></textarea>
            </div>
            @include('livewire.widgets.admin.form.error')
        </div>
    </div>
@endif


