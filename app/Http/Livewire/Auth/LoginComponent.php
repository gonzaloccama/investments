<?php

namespace App\Http\Livewire\Auth;

use Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public $currentPath;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $attributes = [
        'email' => '<b><ins>Email</ins></b>',
        'password' => '<b><ins>Contraseña</ins></b>',
    ];

    public function mount()
    {
        if (\Illuminate\Support\Facades\Auth::user()) {
            $this->redirect(route('admin.dashboard'));
        }

        $this->currentPath = request()->path();
    }

    public function render()
    {
        $data['is_auth'] = true;
        $_data['_title'] = 'Login';

        $this->emit('refreshComponent');

        return view('livewire.auth.login-component', $_data)->layout('layouts.admin', $data);
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    public function login(Request $request)
    {
        $this->validate($this->rules, [], $this->attributes);

        if ($this->attemptLogin()) {
            $request->session()->regenerate();
            return redirect()->intended($this->redirectTo());
        }
        session()->flash('error', 'Estas credenciales no coinciden con nuestros registros.');
        return;
    }

    protected function attemptLogin()
    {
        return $this->guard()->attempt(
            ['email' => $this->email, 'password' => $this->password],
        );
    }

    protected function guard()
    {
        return \Illuminate\Support\Facades\Auth::guard();
    }

    protected function redirectTo()
    {
        if (Auth::user()->role == 1) {
            return '/admin/users';  // admin dashboard path
        } else {
            return '/';  // member dashboard path
        }
    }
}
