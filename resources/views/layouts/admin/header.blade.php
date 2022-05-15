<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1"/>
                <rect x="0.48" y="7.5" width="7" height="1"/>
                <rect x="0.48" y="15.5" width="7" height="1"/>
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1"/>
                <rect x="1.56" y="7.5" width="16" height="1"/>
                <rect x="1.56" y="15.5" width="16" height="1"/>
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1"/>
                <rect x="0.5" y="7.5" width="25" height="1"/>
                <rect x="0.5" y="15.5" width="25" height="1"/>
            </svg>
        </a>

        <div class="search" data-search-path="Pages.Search.html?q=">
            <input placeholder="Buscar...">
            <span class="search-icon">
                    <i class="simple-icon-magnifier"></i>
                </span>
        </div>

    </div>

    <a class="navbar-logo" href="{{ route('admin.dashboard') }}">
        <span class="d-none d-xs-block">
            <img src="{{ asset('assets/logos/logo.png') }}" alt="Accion Regional" style="height: 40px;">
{{--            <span>Acción Regional</span>--}}
        </span>
        <span class="d-block d-xs-none">
            <img src="{{ asset('assets/logos/logo.png') }}" alt="Accion Regional" style="height: 40px;">
{{--            <span>Acción Regional</span>--}}
        </span>
    </a>

    <div class="navbar-right">
        <div class="header-icons d-inline-block align-middle">
            <div class="d-none d-md-inline-block align-text-bottom mr-3">
                <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1"
                     data-toggle="tooltip" data-placement="left" title="Modo oscuro">
                    <input class="custom-switch-input" id="switchDark" type="checkbox" checked>
                    <label class="custom-switch-btn" for="switchDark"></label>
                </div>
            </div>

            <div class="position-relative d-none d-sm-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="iconMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="iconMenuDropdown"
                     style="height: 110px !important;">


                    <a href="{{ route('admin.investments') }}" class="icon-menu-item">
                        <i class="simple-icon-layers d-block"></i>
                        <span>Inversiones</span>
                    </a>

                    <a href="{{ route('admin.upcoming-payments') }}" class="icon-menu-item">
                        <i class="iconsminds-folders d-block"></i>
                        <span>Retorno</span>
                    </a>

                </div>
            </div>

            @if(0)
                <div class="position-relative d-inline-block">
                    <button class="header-icon btn btn-empty" type="button" id="notificationButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="simple-icon-bell"></i>
                        <span class="count">3</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right mt-3 position-absolute" id="notificationDropdown">
                        <div class="scroll">
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('assets/img/profiles/l-2.jpg') }}" alt="Notification Image"
                                         class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"/>
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">Joisse Kaycee just sent a new comment!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('assets/img/notifications/1.jpg') }}" alt="Notification Image"
                                         class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"/>
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">1 item is out of stock!</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 border-bottom">
                                <a href="#">
                                    <img src="{{ asset('assets/img/notifications/2.jpg') }}" alt="Notification Image"
                                         class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"/>
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">New order received! It is total $147,20.</p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex flex-row mb-3 pb-3 ">
                                <a href="#">
                                    <img src="{{ asset('assets/img/notifications/3.jpg') }}" alt="Notification Image"
                                         class="img-thumbnail list-thumbnail xsmall border-0 rounded-circle"/>
                                </a>
                                <div class="pl-3">
                                    <a href="#">
                                        <p class="font-weight-medium mb-1">3 items just added to wish list by a user!
                                        </p>
                                        <p class="text-muted mb-0 text-small">09.04.2018 - 12:45</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


            <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton">
                <i class="simple-icon-size-fullscreen"></i>
                <i class="simple-icon-size-actual"></i>
            </button>

        </div>

        <div class="user d-inline-block">
            <?php
            $img = auth()->user()->gender == 2 ? 'woman.svg' : 'man.svg';
            $profile = auth()->user()->picture ? auth()->user()->picture : $img;
            ?>
            <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                <span class="name">{{ auth()->user()->fullname }}</span>
                <span>
                        <img alt="Profile Picture" src="{{ asset('assets/img/avatar').'/'.$profile }}"/>
                    </span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">
                <a class="dropdown-item" href="{{ route('admin.profile') . '?tab=edit-profile' }}">Mi cuenta</a>
                <a class="dropdown-item" href="{{ route('admin.profile') . '?tab=chang-pwd' }}">Cambiar Contraseña</a>
                <div class="separator"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar sesión
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>

            </div>
        </div>
    </div>
</nav>
