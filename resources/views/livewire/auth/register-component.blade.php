<div class="row h-100">
    @push('title') {{ $_title }} @endpush
    <div class="col-12 col-md-10 mx-auto my-auto">
        <div class="card auth-card">
            <div class="position-relative image-side" style="background: #1e6aa7 !important;">
                <p class=" text-white h2">Inversiones SUR CAPITAL</p>
                <p class="white mb-0">
                    Utilice este formulario para registrarse.
                    <br>Si es miembro, por favor
                    <a href="#" class="white">Iniciar sesión</a>.
                </p>
            </div>
            <div class="form-side">
                <h2 class="mb-4">Crear una cuenta</h2>
                <h6 class="mb-3">Información personal</h6>

                <form>

                    <?php
                    $dt = [
                        'name' => 'firstname',
                        'text' => 'Nombres',
                        'type' => 'text',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

                    <?php
                    $dt = [
                        'name' => 'lastname',
                        'text' => 'Apellidos',
                        'type' => 'text',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

                    <?php
                    $dt = [
                        'name' => 'dni',
                        'text' => 'DNI',
                        'type' => 'text',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

                    <?php
                    $dt = [
                        'name' => 'mobile',
                        'text' => 'Celular',
                        'type' => 'text',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

                    <h6 class="mb-3">Credenciales de usuario</h6>

                    <?php
                    $dt = [
                        'name' => 'username',
                        'text' => 'Nombre de usuario',
                        'type' => 'text',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)

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

                    <?php
                    $dt = [
                        'name' => 'confirm_password',
                        'text' => 'Confirmar contraseña',
                        'type' => 'password',
                        'required' => 1,
                    ];
                    ?>
                    @include('livewire.widgets.admin.form.input-float', $dt)


                    <div class="d-flex justify-content-end align-items-center">
                        <button class="btn btn-primary btn-lg btn-shadow" wire:click.prevent="register"
                                type="submit">REGISTRAR
                        </button>
                    </div>


                    @if($message = Session::get('error'))
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @endif

                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            window.livewire.on('refreshComponent', () => {
                $("#username").validate();
            });

        });
    </script>
@endpush
