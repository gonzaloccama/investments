<?php
$icons = [
    'view' => 'simple-icon-eye',
    'show' => 'simple-icon-layers',
    'edit' => 'simple-icon-note',
    'go' => 'simple-icon-action-redo',
    'delete' => 'simple-icon-trash',
];
$wire = [
    'view' => 'openView(' . $result->id . ')',
    'show' => 'show(' . $result->id . ')',
    'edit' => 'edit(' . $result->id . ')',
    'go' => '',
    'delete' => 'deleteConfirm(' . $result->id . ')',
];
?>

@foreach($actions as $key => $action)
    @if($key == 'delete')
        <div class="dropdown-divider"></div>
    @endif
    @if($action)
        <a class="dropdown-item {{ $key == 'delete' ? 'text-danger' : '' }}" href="#"
           wire:click.prevent="{{ $wire[$key] }}">
            <i class="{{ $icons[$key] }}" style="font-size: 18px; position: absolute;"></i>
            <span style="margin-left: 25px;">{{ $action }}</span>
        </a>
    @endif
@endforeach
<?php
unset($icons);
unset($wire);
?>

