<div class="col-md-12">
    <div class="card border rounded-0">
        <div class="card-header pl-0 pr-0">
            <ul class="nav nav-tabs nav-nowrap card-header-tabs  ml-0 mr-0" style="overflow: hidden;"
                role="tablist">
                <div class="scrollbar __scroller ml-4 mr-4">
                    <li class="nav-item w-45 text-center">
                        <a class="nav-link font-16 {{ $tab == 'edit-profile' ? 'active' : '' }} ml-0 mr-0 pl-0 pr-0"
                           id="first-tab_" data-toggle="tab" wire:click.prevent="openTab('edit-profile')"
                           href="#edit-profile-tab" role="tab" aria-controls="first"
                           aria-selected="{{ $tab == 'edit-profile' ? 'true' : 'false' }}">
                            Perfil<br/><small style="font-size: 10px !important;">Editar información personal</small>
                        </a>
                    </li>

                    <li class="nav-item w-45 text-center ml-0 mr-0">
                        <a class="nav-link font-16 {{ $tab == 'chang-pwd' ? 'active' : '' }}"
                           id="second-tab_" data-toggle="tab" href="#chang-pwd"
                           wire:click.prevent="openTab('chang-pwd')"
                           role="tab" aria-controls="second"
                           aria-selected="{{ $tab == 'chang-pwd' ? 'true' : 'false' }}">Contraseña <br/>
                            <small style="font-size: 10px !important;">Cambiar contraseña</small>
                        </a>
                    </li>
                </div>
            </ul>
        </div>
        <div class="card-body">
            @if($tab)
                @include('livewire.admin.profile.tabs.' . $tab)
            @endif
        </div>
    </div>
</div>
