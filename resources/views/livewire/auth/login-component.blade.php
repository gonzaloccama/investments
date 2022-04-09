<div class="row h-100">
    @push('title') {{ $_title }} @endpush
    <div class="col-12 col-md-10 mx-auto my-auto">
        <div class="card auth-card">
            <div class="position-relative image-side ">

                <p class=" text-white h2">MAGIC IS IN THE DETAILS</p>

                <p class="white mb-0">
                    Please use your credentials to login.
                    <br>If you are not a member, please
                    <a href="#" class="white">register</a>.
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
                        <button class="btn btn-primary btn-lg btn-shadow" wire:click.prevent="login" type="submit">Iniciar sesión</button>
                    </div>
                </form>

                @if($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
