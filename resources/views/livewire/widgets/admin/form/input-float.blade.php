<div class="form-group mb-3">
    <label class="form-group has-float-label mb-1 @error($name) error-validate @enderror">
    <input type="{{ $type }}" class="form-control @error($name) validate @enderror" wire:model="{{ $name }}"
           id="{{ $name }}">
    <span>{{ $text }} {!! $required ? '<i class="text-danger">*</i>' : '' !!}</span>
    </label>
    @error($name) <span class="text-danger">{!! $message !!}</span> @enderror
</div>
