<div class="col-md-12">
    <div class="card border rounded-0">
        <div class="position-absolute card-top-buttons">
            <button class="btn btn-header-light icon-button" wire:click.prevent="closeFrame">
            <span style="color: white;position: absolute; margin-top: -17px; margin-left: -12px">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="1" fill="none"
                     stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </span>
            </button>
        </div>

        <div class="card-body">
            <h5 class="card-title text-muted text-uppercase pt-0 mt-0 mb-4 title-nowrap">
                {{ $_user ? $_user->fullname : __('Nuevo Inversión') }}
            </h5>
            <div class="separator mb-5"></div>


            <div class="row">
                <div class="col-md-7">
                    <div class="text-left mt-1">
                        <h5 class="mb-3">Buscar inversionista</h5>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <div class="form-group">

                                <div class="input-group mb-5">
                                    <input class="form-control" type="search" value="search"
                                           id="example-search-input"
                                           style="border-radius: 25px 0 0 25px" wire:model="keyTex"
                                           placeholder="Buscar...">
                                    <span class="input-group-append">
                                            <button class="btn btn-outline-dark" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                </div>
                                @if(isset($_users) && !empty($_users))
                                    @foreach($_users as $user)
                                        <?php
                                        $img = $user->gender == 2 ? 'woman.svg' : 'man.svg';
                                        $profile = $user->picture ? $user->picture : $img;
                                        ?>
                                        <div class="d-flex flex-row mb-3 p-3 border-bottom hover-list">
                                            <a href="#"
                                               wire:click.prevent="updateSelectInvestment({{ $user->id }})">
                                                <img src="{{ asset('assets/img/avatar/').'/'.$profile }}"
                                                     alt="{{ $user->fullname }}"
                                                     class="img-thumbnail border-0 rounded-circle list-thumbnail align-self-center xsmall"/>
                                            </a>
                                            <div class="pl-3">
                                                <a href="#"
                                                   wire:click.prevent="updateSelectInvestment({{ $user->id }})">
                                                    <p class="font-weight-medium mb-0 ">{{ $user->fullname }}</p>
                                                    <p class="text-muted mb-0 text-small">DNI: {{ $user->dni }}</p>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex flex-row mb-3 p-3 hover-list font-italic">
                                        Busque inversionista por <b>&nbsp;DNI, Nombre o Apellidos&nbsp;</b> para
                                        crear.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mt-5 mt-md-0">

                    @if($userId)
                        <div class="text-md-right text-left mb-3">
                            <button type="submit" class="btn btn-secondary btn-xs"
                                    wire:click.prevent="openCreateInvestment">
                                <b><i class="iconsminds-add-user"></i>&nbsp;&nbsp;Nuevo</b>
                            </button>
                            <button type="submit" class="btn btn-secondary btn-xs"
                                    wire:click.prevent="openCreateInvestment">
                                <b><i class="iconsminds-user"></i>&nbsp;&nbsp;Elegir</b>
                            </button>
                        </div>
                        @include('livewire.admin.investments.details.user', ['dt' => $_user])
                    @endif

                </div>
            </div>


            <div class="separator mb-5 mt-5"></div>

            <div class="text-right">
                <button class="btn btn-secondary btn-sm"
                        wire:click.prevent="closeFrame">
                    <b><i class="simple-icon-logout"></i>&nbsp;&nbsp;Regresar</b>
                </button>
                @if($userId)
                    <button type="submit" class="btn btn-secondary btn-sm"
                            wire:click.prevent="openCreateInvestment">
                        <b><i class="iconsminds-user"></i>&nbsp;&nbsp;Elegir usuario</b>
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
