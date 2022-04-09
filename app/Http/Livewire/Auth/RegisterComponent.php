<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Auth;
use Hash;
use Livewire\Component;
use Validator;

class RegisterComponent extends Component
{
    public $username;
    public $email;
    public $mobile;
    public $dni;
    public $firstname;
    public $lastname;
    public $password;
    public $confirm_password;

    protected $attributes = [
        'username' => '<b><ins>Nombre de usuario</ins></b>',
        'email' => '<b><ins>Email</ins></b>',
        'mobile' => '<b><ins>Celular</ins></b>',
        'dni' => '<b><ins>DNI</ins></b>',
        'firstname' => '<b><ins>Nombres</ins></b>',
        'lastname' => '<b><ins>Apellidos</ins></b>',
        'password' => '<b><ins>Contraseña</ins></b>',
        'confirm_password' => '<b><ins>Confirmar contraseña</ins></b>',
    ];


    protected $rules = [
        'username' => 'required|min:3|without_spaces|unique:users',
        'email' => 'required|email|unique:users',
        'mobile' => 'required|numeric|digits:9|unique:users',
        'dni' => 'required|numeric|digits:8',
        'firstname' => 'required|min:3',
        'lastname' => 'required|min:3',
        'password' => 'required|min:6|special_chars',
        'confirm_password' => 'required|required|same:password',
    ];

    public function mount()
    {
        if (Auth::user()) {
            $this->redirect(route('admin.dashboard'));
        }
        else {
            $this->redirect(route('login'));
        }
    }

    public function render()
    {
        $data['is_auth'] = true;
        $_data['_title'] = 'Login';

        $this->emit('refreshComponent');

        return view('livewire.auth.register-component', $_data)->layout('layouts.admin', $data);
    }

    public function updated($property)
    {
        $this->customValidation();

        $this->validateOnly($property, $this->rules,
            [
                'username.without_spaces' => ':attribute no debe contener espacios',
                'password.special_chars' => ':attribute debe contener Mayusculas, numeros y al menos un caracter especial !$@#%_~',
            ]
            , $this->attributes
        );
    }

    public function register()
    {
       $this->customValidation();

        $this->validate($this->rules,
            [
                'username.without_spaces' => ':attribute no debe contener espacios',
                'password.special_chars' => ':attribute debe contener números y al menos un caracter especial !$@#%_~',
            ]
            , $this->attributes
        );

        $register = new User();

        $register->username = $this->username;
        $register->email = $this->email;
        $register->mobile = $this->mobile;
        $register->dni = $this->dni;
        $register->firstname = $this->firstname;
        $register->lastname = $this->lastname;
        $register->password = Hash::make($this->password);
        $register->group = 5;

        if ($register->save()) {
            $this->cleanItems();
            $this->redirect(route('admin.dashboard'));
        }else{
            session()->flash('error', '¡Algo salio mal!.');
        }
    }

    protected function redirectTo()
    {
        if (Auth::user()->role == 1) {
            return '/admin/users';  // admin dashboard path
        } else {
            return '/';  // member dashboard path
        }
    }

    public function cleanItems()
    {
        $this->username = null;
        $this->email = null;
        $this->mobile = null;
        $this->dni = null;
        $this->firstname = null;
        $this->lastname = null;
        $this->password = null;
        $this->confirm_password = null;
    }

    private function customValidation()
    {
        Validator::extend('without_spaces', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });

        Validator::extend('special_chars', function ($attr, $value) {
            return preg_match('/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$@#%_~]).*$/', $value);
        });
    }
}
