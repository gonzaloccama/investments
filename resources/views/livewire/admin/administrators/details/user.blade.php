<div class="card d-flex flex-row mb-4 pt-3 pb-3 border">
    <?php
    $img = $dt->gender == 2 ? 'woman.svg' : 'man.svg';
    $profile = $dt->picture ? $dt->picture : $img;
    ?>
    <a class="d-flex" href="javascript:;">
        <img alt="{{ $dt->fullname }}" src="{{ asset('assets/img/avatar/').'/' . $profile }}"
             class="img-thumbnail border-0 rounded-circle m-4 list-thumbnail align-self-center">
    </a>
    <div class=" d-flex flex-grow-1 min-width-zero">
        <div
            class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
            <div class="min-width-zero">
                <a href="javascript:;">
                    <p class="list-item-heading mb-1 truncate">{{ $dt->fullname }}</p>
                </a>
                <p class="mb-2 text-muted text-small">DNI: {{ $dt->dni }}</p>
            </div>
        </div>

        <div
            class="card-body pl-0 align-self-center d-flex flex-column flex-lg-row justify-content-between min-width-zero">
            <div class="min-width-zero">
                <a href="javascript:;">
                    <p class="list-item-heading mb-1 truncate text-muted">CELULAR: {{ $dt->mobile }}</p>
                </a>
                <p class="mb-2 text-muted text-small">CORREO: {{ $dt->email }}</p>
            </div>
        </div>
    </div>
</div>

{{--<p class="text-muted text-small mb-2">Correo</p>--}}
{{--<p class="mb-3">{{ $dt->email }}</p>--}}

{{--<p class="text-muted text-small mb-2">Celular</p>--}}
{{--<p class="mb-3">{{ $dt->mobile }}</p>--}}

{{--<p class="text-muted text-small mb-2">Dirección</p>--}}
{{--<p class="mb-3">{{ $dt->address }}</p>--}}

{{--<p class="text-muted text-small mb-2">Ciudad</p>--}}
{{--<p class="mb-3">{{ $dt->city }}</p>--}}

{{--<p class="text-muted text-small mb-2">Provincia, Región</p>--}}
{{--<p class="mb-3">{{ $dt->province }}, {{ $dt->u_region->region }}</p>--}}
