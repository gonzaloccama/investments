<?php
$img = $dt->gender == 2 ? 'woman.svg' : 'man.svg';
$profile = $dt->cover ? $dt->cover : $img;
?>
<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-2">
        <div class="card border-top border-bottom d-flex flex-row mb-4" style="height: 154px">
            <a class="d-flex" href="#">
                <img alt="Profile" src="{{ asset('assets/img/avatar') . '/' . $profile }}"
                     class="img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center">
            </a>
            <div class=" d-flex flex-grow-1 min-width-zero">
                <div
                    class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
                    <div class="min-width-zero">
                        <a href="#">
                            <p class="list-item-heading mb-1 truncate">{{ $dt->firstname . ' ' . $dt->lastname }}</p>
                        </a>
                        <p class="mb-2 text-muted text-small">{{ $dt->user_role->role ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card border-top border-bottom mb-2" style="height: 154px">
            <div class="card-body">

                <p class="mb-0 text-semi-muted">
                    <b><abbr title="DNI">DNI:</abbr></b> {{ $dt->dni }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr title="DNI">CELULAR:</abbr></b> {{ $dt->mobile }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr title="Correo">CORREO:</abbr></b> {{ $dt->email }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr
                            title="Sexo">GENERO:</abbr></b> {{ $dt->u_gender->gender ?? '' }}
                </p>

            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-4">
        <div class="card border-top border-bottom mb-2" style="height: 154px">
            <div class="card-body">

                <p class="mb-0 text-semi-muted">
                    <b><abbr title="Dirección">DIRECCIÓN:</abbr></b> {{ $dt->address }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr title="Ciudad">CIUDAD:</abbr></b> {{ $dt->city }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr
                            title="Provincia">PROVINCIA:</abbr></b> {{ $dt->province ?? '' }}
                </p>
                <p class="mb-0 text-semi-muted">
                    <b><abbr title="Región">REGIÓN:</abbr></b>
                    {{ isset($dt->u_region) && !empty($dt->u_region) ? $dt->u_region->region : '' }}
                </p>
            </div>
        </div>
    </div>
</div>
