<div class="mb-2">
    <a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse" href="#displayOptions"
       role="button" aria-expanded="true" aria-controls="displayOptions">
        Mostrar opciones
        <i class="simple-icon-arrow-down align-middle"></i>
    </a>
    <div class="collapse d-md-block" id="displayOptions">
        <div class="mr-3 mb-2 d-inline-block float-md-left">
            <a href="#" class="mr-2 view-icon active">
                @if(isset($mode))
                    @if($mode == 'square')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                            <path class="view-icon-svg"
                                  d="M7,2V8H1V2H7m.12-1H.88A.87.87,0,0,0,0,1.88V8.12A.87.87,0,0,0,.88,9H7.12A.87.87,0,0,0,8,8.12V1.88A.87.87,0,0,0,7.12,1Z"/>
                            <path class="view-icon-svg"
                                  d="M17,2V8H11V2h6m.12-1H10.88a.87.87,0,0,0-.88.88V8.12a.87.87,0,0,0,.88.88h6.24A.87.87,0,0,0,18,8.12V1.88A.87.87,0,0,0,17.12,1Z"/>
                            <path class="view-icon-svg"
                                  d="M7,12v6H1V12H7m.12-1H.88a.87.87,0,0,0-.88.88v6.24A.87.87,0,0,0,.88,19H7.12A.87.87,0,0,0,8,18.12V11.88A.87.87,0,0,0,7.12,11Z"/>
                            <path class="view-icon-svg"
                                  d="M17,12v6H11V12h6m.12-1H10.88a.87.87,0,0,0-.88.88v6.24a.87.87,0,0,0,.88.88h6.24a.87.87,0,0,0,.88-.88V11.88a.87.87,0,0,0-.88-.88Z"/>
                        </svg>
                    @elseif($mode == 'list')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19">
                            <path class="view-icon-svg" d="M17.5,3H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z"/>
                            <path class="view-icon-svg"
                                  d="M3,2V3H1V2H3m.12-1H.88A.87.87,0,0,0,0,1.88V3.12A.87.87,0,0,0,.88,4H3.12A.87.87,0,0,0,4,3.12V1.88A.87.87,0,0,0,3.12,1Z"/>
                            <path class="view-icon-svg"
                                  d="M3,9v1H1V9H3m.12-1H.88A.87.87,0,0,0,0,8.88v1.24A.87.87,0,0,0,.88,11H3.12A.87.87,0,0,0,4,10.12V8.88A.87.87,0,0,0,3.12,8Z"/>
                            <path class="view-icon-svg"
                                  d="M3,16v1H1V16H3m.12-1H.88a.87.87,0,0,0-.88.88v1.24A.87.87,0,0,0,.88,18H3.12A.87.87,0,0,0,4,17.12V15.88A.87.87,0,0,0,3.12,15Z"/>
                            <path class="view-icon-svg"
                                  d="M17.5,10H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z"/>
                            <path class="view-icon-svg"
                                  d="M17.5,17H6.5a.5.5,0,0,1,0-1h11a.5.5,0,0,1,0,1Z"/>
                        </svg>
                    @endif
                @endif
            </a>
        </div>
        <div class="d-block d-md-inline-block">

            @if(isset($filters) && !empty($filters))
                <div class="btn-group float-md-left mr-1 mb-1">
                    <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Filtrar por:
                    </button>

                    <div class="dropdown-menu">
                        @foreach($filters as $ftr)
                            <a class="dropdown-item {{ $ftr->id === $filter ? 'active' : '' }}"
                               wire:click.prevent="updateFilter({{ $ftr->id }})"
                               href="javascript:;">{{ ucfirst($ftr->name) }}</a>
                        @endforeach
                            <a class="dropdown-item {{ !$filter ? 'active' : '' }}"
                               wire:click.prevent="updateFilter(null)"
                               href="javascript:;">{{ __('Todo') }}</a>
                    </div>
                </div>
            @endif


            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                <input placeholder="Buscar..." wire:model="keyWord">
            </div>
        </div>

        <div class="float-md-right">
            <span class="text-muted text-small mr-1">Mostrar:  </span>
            <button class="btn btn-outline-dark btn-xs dropdown-toggle" type="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $limit }}
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <?php
                $sizePages = [4, 8, 16, 32, 64, 128];
                ?>
                @foreach($sizePages as $size)
                    <a class="dropdown-item {{ $limit === $size ? 'active' : '' }}" href="#"
                       wire:click.prevent="updatePagination({{ $size }})">{{ $size }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
