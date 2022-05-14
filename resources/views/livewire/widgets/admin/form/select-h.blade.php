@if(isset($name) && !empty($name))

    <div class="form-group row">
        <label for="{{ $name }}"
               class="col-sm-3 col-form-label">{{ $text }} {!! $required ? '<i class="text-danger">*</i>':'' !!}</label>
        <div class="col-sm-9" {{ isset($ignore) && !empty($ignore) ? 'wire:ignore' : '' }} >

            <select id="{{ $name }}" class="form-control" wire:model="{{ $name }}" style="width: 100%"
                {{ isset($multiple) && !empty($multiple) ? 'multiple' : '' }}>
                <option>Seleccione...</option>
                @if($object)
                    @if($object == 'array')
                        @foreach($options as $option)
                            <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                        @endforeach
                    @else
                        @foreach($options as $option)
                            <option value="{{ $option->id }}">{{ $option[$object] }}</option>
                        @endforeach
                    @endif
                @else
                    @foreach($options as $key => $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                @endif
            </select>


            @include('livewire.widgets.admin.form.error')

        </div>
    </div>

@endif
