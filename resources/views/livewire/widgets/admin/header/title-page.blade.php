<div class="mb-3 title-page">
    <h1>{{ $_title }}</h1>
    @if(isset($buttons['is_add']) && !empty($buttons['is_add']))
        <div class="text-zero top-right-button-container">
            <button class="btn btn-secondary btn-sm"
                    wire:click.prevent="openFrame">
                <b><i class="simple-icon-plus"></i>&nbsp;&nbsp;NUEVO</b>
            </button>
        </div>
    @endif
    @include('livewire.widgets.admin.header.breadrumb')
</div>

