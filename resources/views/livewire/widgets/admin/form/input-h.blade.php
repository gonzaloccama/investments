@if(isset($name) && !empty($name))
    <?php
    $txt = '';
    if (isset($dimensions) && !empty($dimensions)) {
        $txt = '<span class="text-danger font-10">(resolución: <b>' . $dimensions . '</b>)</span>';
    }
    ?>

    <div class="form-group row">
        <label for="{{ $name }}"
               class="col-sm-3 col-form-label">{{ $text }} {!! $required ? $txt . '<i class="text-danger">*</i>':'' !!}</label>
        <div class="col-sm-9 @error($name) error-validate @enderror">

            @if(in_array($type, ['text', 'password']))
                <input type="{{ $type }}" class="form-control" id="{{ $name }}" wire:model="{{ $name }}"
                       {{ isset($readonly) && !empty($readonly) ? 'readonly' : '' }} placeholder="{{ $text }}"
                       autocomplete="off">
            @elseif($type == 'checkbox')
                <div class="custom-switch custom-switch-primary mb-2">
                    <input class="custom-switch-input" id="{{ $name }}" type="{{ $type }}"
                           wire:model="{{ $name }}">
                    <label class="custom-switch-btn" for="{{ $name }}"></label>
                </div>
            @elseif($type == 'file')
                <?php
                $acc = isset($accept) && !empty($accept) ? $accept == 'image' ? 'image/jpeg, image/png, image/png' : 'application/pdf' : '';
                ?>
                <div class="input-group mb-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Cargar</span>
                    </div>
                    <div class="custom-file">
                        <input type="{{ $type }}" class="custom-file-input" id="{{ $name }}" wire:model="{{ $name }}"
                               accept="{{ $acc }}">

                        <label class="custom-file-label" for="{{ $name }}">Elejir archivo</label>
                    </div>
                </div>
                <div class="" wire:loading wire:target="{{ $name }}">Cargando...</div>
            @elseif($type == 'radio')
                {{--                <div class="radio-check">--}}
                {{--                    <input type="radio" value="{{ $val1[0] }}" id="{{ $val1[2] }}"--}}
                {{--                           wire:model="{{ $name }}">--}}
                {{--                    <input type="radio" value="{{ $val2[0] }}" id="{{ $val2[2] }}"--}}
                {{--                           wire:model="{{ $name }}">--}}
                {{--                    <label for="{{ $val1[2] }}" class="option option-1">--}}
                {{--                        <span>{{ $val1[1] }}</span>--}}
                {{--                    </label>--}}
                {{--                    <label for="{{ $val2[2] }}" class="option option-2">--}}
                {{--                        <span>{{ $val2[1] }}</span>--}}
                {{--                    </label>--}}
                {{--                </div>--}}

                <div class="radio-button">

                    <input type="radio" id="{{ $val1[2] }}" value="{{ $val1[0] }}" wire:model="{{ $name }}">
                    <label for="{{ $val1[2] }}">{{ $val1[1] }}</label>

                    <input type="radio" id="{{ $val2[2] }}" value="{{ $val2[0] }}" wire:model="{{ $name }}">
                    <label for="{{ $val2[2] }}">{{ $val2[1] }}</label>

                    <div id="flap">
                        <span class="content">
                            {{ $var_model == $val1[0] ? $val1[1] :  $val2[1] }}
                        </span>
                    </div>

                </div>

            @endif


            @include('livewire.widgets.admin.form.error')


        </div>
    </div>

@endif
