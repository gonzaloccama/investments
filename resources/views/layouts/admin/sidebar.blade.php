<div class="menu">
    <?php
    $menus = \App\Models\SystemMenu::orderBy('order')->with('children', function ($query) {
        $query->orderBy('order');
    })->where('type', 'admin')->whereNull('parent')->get();
    ?>
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                @foreach($menus as $menu)
                    <?php
                    $children = [];

                    foreach ($menu->children as $child) {
                        $children[] = $child->route;
                    }
                    ?>
                    @if(in_array(auth()->user()->group, json_decode($menu->in_group)))
                        <li class="{{ in_array(Route::currentRouteName(), $children) || Route::currentRouteName() == $menu->route  ? 'active' : '' }} text-center">
                            <a href="{{ (int)$menu->is_route ? route($menu->route) : '#'.$menu->route }}">
                                <i class="{{ $menu->icon }}"></i> {{ $menu->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <div class="sub-menu">
        <div class="scroll">
            @foreach($menus as $menu)
                <ul class="list-unstyled" data-link="{{ $menu->route }}">
                    @if(filled($menu->children))
                        @foreach($menu->children as $smenu)
                            <li class="{{ Route::currentRouteName() == $smenu->route ? 'active' : '' }}">
                                <a href="{{ route($smenu->route) }}">
                                    <i class="iconsminds-voice"></i>
                                    <span class="d-inline-block">{{ $smenu->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            @endforeach
        </div>
    </div>
</div>
