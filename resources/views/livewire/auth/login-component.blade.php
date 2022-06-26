<div class="row h-100">
    @push('title')
        {{ $_title }}
    @endpush
    <div class="col-12 col-md-10 mx-auto my-auto " style="bottom: 50% !important; top: 50% !important;">
        <div class="card auth-card rounded-0 shadow-lg">
            <div class="position-relative image-side rounded-0">

                <p class="text-white text-center h2 p-3"
                   style="background-color: rgba(6,8,24,0.51) !important; font-weight: 700; border: 1px solid rgba(255,255,255,0.18);">
                    INVERSIONES<br>SUR CAPITAL
                </p>

                <p class="white mb-0 p-3"
                   style="background-color: rgba(6,8,24,0.51) !important;; border: 1px solid rgba(255,255,255,0.18);">
                    Utilice sus credenciales para iniciar sesión.
                    <br>Si no es miembro, por favor
                    <a href="#" class="white">registrar</a>.
                </p>
            </div>
            <div class="form-side">

                <h6 class="mb-4">Iniciar sesión</h6>
                <form>
                    <?php
                    $dt = [
                        'name' => 'email',
                        'text' => 'Correo Electrónico',
                        'type' => 'text',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

                    <?php
                    $dt = [
                        'name' => 'password',
                        'text' => 'Contraseña',
                        'type' => 'password',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="#">¿Contraseña olvidada?</a>
                        <div wire:loading.remove wire:target="login">
                            <button class="btn btn-secondary btn-lg btn-shadow" wire:click.prevent="login" type="submit">
                                Iniciar sesión
                            </button>
                        </div>
                        <div wire:loading wire:target="login">
                            <button class="btn btn-secondary btn-lg btn-shadow disabled text-white-50">
                                <div class="spinner-grow text-light spinner-grow-sm" role="status"></div>
                                Iniciando...
                            </button>
                        </div>
                    </div>
                </form>

                @if($message = Session::get('error'))
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
