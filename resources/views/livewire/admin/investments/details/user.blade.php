
        <?php
        $img = $dt->gender == 2 ? 'woman.svg' : 'man.svg';
        $profile = $dt->picture ? $dt->picture : $img;
        ?>
        <div class="text-center mt-2">
            <img alt="{{ $dt->fullname }}" src="{{ asset('assets/img/avatar/').'/' . $profile }}"
                 class="img-thumbnail border-0 rounded-circle mb-4 list-thumbnail">
            <p class="list-item-heading mb-1">{{ $dt->fullname }}</p>
            <p class="mb-4 text-muted text-small">DNI: {{ $dt->dni }}</p>
        </div>

        <p class="text-muted text-small mb-2">Correo</p>
        <p class="mb-3">{{ $dt->email }}</p>

        <p class="text-muted text-small mb-2">Celular</p>
        <p class="mb-3">{{ $dt->mobile }}</p>

        <p class="text-muted text-small mb-2">Dirección</p>
        <p class="mb-3">{{ $dt->address }}</p>

        <p class="text-muted text-small mb-2">Ciudad</p>
        <p class="mb-3">{{ $dt->city }}</p>

        <p class="text-muted text-small mb-2">Provincia</p>
        <p class="mb-3">{{ $dt->province }}</p>

        <p class="text-muted text-small mb-2">Región</p>
        <p class="mb-3">{{ $dt->u_region->region ?? '...' }}</p>

{{--        <p class="text-muted text-small mb-2">Región</p>--}}
{{--        <p class="mb-3">{{ $dt->u_region->region }}</p>--}}


{{--<div class="card border rounded-0 p-4 mb-5">--}}
{{--    <div class="row ">--}}
{{--        <div class="col-12 col-sm-6 col-md-3 mt-3 mt-md-0">--}}
{{--            <div class="d-inline p-2 color-theme-2">DNI:</div>--}}
{{--            <div class="d-inline p-2">{{ $dt->dni }}</div>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Nombres:</h6>--}}
{{--            --}}{{--            <p>{{ $dt->fullname }}</p>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Fecha de nacimiento:</h6>--}}
{{--            --}}{{--            <p>{{ $dt->birthdate }}</p>--}}
{{--        </div>--}}

{{--        <div class="col-12 col-sm-6 col-md-3 mt-3 mt-md-0">--}}
{{--            <div class="d-inline p-2 color-theme-2">Nombres:</div>--}}
{{--            <div class="d-inline p-2">{{ $dt->fullname }}</div>--}}
{{--            --}}{{--            <h6 class="color-theme-2">Genero:</h6>--}}
{{--            --}}{{--            <p>{{ isset($dt->u_gender->gender) && !empty($dt->u_gender->gender) ? $dt->u_gender->gender : '' }}</p>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Estado Civil:</h6>--}}
{{--            --}}{{--            <p>{{ $dt->u_relationship->relationship ?? '' }}</p>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Profesión/Ocupación:</h6>--}}
{{--            --}}{{--            <p>{{ $dt->job }}</p>--}}
{{--        </div>--}}

{{--        <div class="col-12 col-sm-6 col-md-3 mt-3 mt-md-0">--}}
{{--            <div class="d-inline p-2 color-theme-2">Correo:</div>--}}
{{--            <div class="d-inline p-2">{{ $dt->email }}</div>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Celular:</h6>--}}
{{--            --}}{{--            <p>{{ $dt->mobile }}</p>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Dirección:</h6>--}}
{{--            --}}{{--            <p>{{ $dt->address }}</p>--}}
{{--        </div>--}}


{{--        <div class="col-12 col-sm-6 col-md-3 mt-3 mt-md-0">--}}
{{--            <div class="d-inline p-2 color-theme-2">Celular:</div>--}}
{{--            <div class="d-inline p-2">{{ $dt->mobile }}</div>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Ciudad:</h6>--}}
{{--            --}}{{--            <p>{{ $dt->city }}</p>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Provincia:</h6>--}}
{{--            --}}{{--            <p>{{ $dt->province }}</p>--}}

{{--            --}}{{--            <h6 class="color-theme-2">Región:</h6>--}}
{{--            --}}{{--            <p>{{isset($dt->u_region->region) && !empty($dt->u_region->region) ? $dt->u_region->region : '' }}</p>--}}
{{--        </div>--}}

{{--    </div>--}}

{{--</div>--}}

