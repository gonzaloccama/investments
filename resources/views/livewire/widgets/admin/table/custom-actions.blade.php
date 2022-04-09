@if(isset($customs['actions']))
    <div class="btn-group dropleft">
        <button type="button" class="btn btn-secondary btn-xs dropdown-toggle"
                style="border-radius: 0px 15px 15px 0px"
                data-toggle="dropdown" aria-expanded="false">
            {{ $customs['txt'] }}
        </button>
        <div class="dropdown-menu">
            @foreach($customs['actions'] as $key => $action)
                @if($action)
                    <a class="dropdown-item {{ $key == $result[$customs['inputs']['two']] ? 'text-success' : '' }}"
                       href="javascript:;"
                       wire:click.prevent="{{ $action . '(' . $result[$customs['inputs']['one']] . ', "'. $key .'")' }}">
                        <i class="simple-icon-arrow-right-circle"
                           style="font-size: 18px; position: absolute;"></i>
                        <span style="margin-left: 25px;">{{ ucfirst($key) }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@elseif(isset($customs['button']))
    <button type="button" class="btn btn-secondary btn-xs"
            style="border-radius: 0px 15px 15px 0px"
            wire:click.prevent="{{ $customs['action'] . '('. $result->id. ')' }}">
        {{ $customs['button'] }}
    </button>
@endif


