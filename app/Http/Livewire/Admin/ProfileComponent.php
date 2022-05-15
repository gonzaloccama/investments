<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Hash;
use Livewire\Component;

class ProfileComponent extends BaseAdmin
{
    public $username;
    public $email;
    public $mobile;

    public $firstname;
    public $lastname;
    public $dni;
    public $gender;
    public $address;
    public $city;
    public $province;
    public $region;
    public $country;
    public $birthdate;
    public $relationship;
    public $job;

    public $current_password;
    public $password;
    public $confirm_password;

    public $tab;

    protected $attributes = [
        'username' => '<b><ins>Nombre usuario</ins></b>',
        'email' => '<b><ins>Correo</ins></b>',
        'mobile' => '<b><ins>Celular</ins></b>',
        'firstname' => '<b><ins>Nombres</ins></b>',
        'lastname' => '<b><ins>Apellidos</ins></b>',
        'dni' => '<b><ins>DNI</ins></b>',
        'gender' => '<b><ins>Género</ins></b>',
        'address' => '<b><ins>Dirección</ins></b>',
        'city' => '<b><ins>Ciudad</ins></b>',
        'province' => '<b><ins>Provincia</ins></b>',
        'region' => '<b><ins>Región</ins></b>',
        'country' => '<b><ins>Pais</ins></b>',
        'birthdate' => '<b><ins>Fecha de nacimiento</ins></b>',
        'relationship' => '<b><ins>Estado civil</ins></b>',

        'current_password' => '<b><ins>Contraseña actual</ins></b>',
        'password' => '<b><ins>Nueva contraseña</ins></b>',
        'confirm_password' => '<b><ins>Confirmar contraseña</ins></b>',
    ];

    protected $rules = [
        'username' => 'required',
        'email' => 'required|email',
        'mobile' => 'required|numeric|digits:9',
        'firstname' => 'required|min:3',
        'lastname' => 'required|min:3',
        'dni' => 'required',
        'gender' => 'nullable',
        'address' => 'nullable',
        'city' => 'nullable',
        'province' => 'nullable',
        'region' => 'nullable',
        'country' => 'nullable',
        'birthdate' => 'nullable',
        'relationship' => 'nullable',

        'current_password' => 'required',
        'password' => 'required|required|min:6|different:current_password',
        'confirm_password' => 'required|same:password',
    ];

    protected $queryString = [
        'tab' => ['except' => ''],
    ];

    public function mount()
    {
        $this->frame = 'index';
    }

    public function render()
    {
        $data['_title'] = 'Perfil';

        $this->emit('refreshContent');

        if ($this->tab == 'edit-profile')
            $this->openTab('edit-profile');

        return view('livewire.admin.profile-component', $data)->layout('layouts.admin');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
        $this->checkPwd();
    }

    public function saveData()
    {
        $data = User::find(auth()->user()->id);

        if ($this->tab == 'edit-profile') {
            $rules = $this->rules;
            unset(
                $rules['current_password'],
                $rules['password'],
                $rules['confirm_password'],
            );

            $this->validate($rules, [], $this->attributes);
            $data->username = $this->username;
            $data->email = $this->email;
            $data->dni = $this->dni;
            $data->firstname = $this->firstname;
            $data->lastname = $this->lastname;
            $data->gender = $this->gender;
            $data->birthdate = $this->birthdate;
            $data->relationship = $this->relationship;
            $data->job = $this->job;
            $data->mobile = $this->mobile;
            $data->address = $this->address;
            $data->city = $this->city;
            $data->province = $this->province;
            $data->region = $this->region;
            $data->country = $this->country;

            if ($data->save()) {
                $this->emit('notification', ['Su perfil se actualizó exitosamente']);
            }

        } elseif ($this->tab == 'chang-pwd') {

            $this->validate([
                'current_password' => 'required',
                'password' => 'required|required|min:6|different:current_password',
                'confirm_password' => 'required|same:password',
            ], [], $this->attributes);

            if ($this->checkPwd()) {
                $data = User::findOrFail(auth()->user()->id);
                $data->password = Hash::make($this->password);
                if ($data->save()) {
                    $this->emit('notification', 'Su contraseña de actualizó correctamente');
                }
            }
        }
    }

    public function openTab($tab)
    {
        $this->cleanItems();

        $this->tab = $tab;
        if ($this->tab == 'edit-profile') {
            $data = User::find(auth()->user()->id);

            $this->username = $data->username;
            $this->email = $data->email;
            $this->dni = $data->dni;

            $this->firstname = $data->firstname;
            $this->lastname = $data->lastname;
            $this->gender = $data->gender;
            $this->birthdate = $data->birthdate;
            $this->relationship = $data->relationship;
            $this->job = $data->job;

            $this->mobile = $data->mobile;
            $this->address = $data->address;
            $this->city = $data->city;
            $this->province = $data->province;
            $this->region = $data->region;
            $this->country = $data->country;
        }
    }


    private function checkPwd()
    {
        if (!Hash::check($this->current_password, auth()->user()->password)) {
            $this->addError(
                'current_password',
                'La <b><ins>Contraseña que ingresó</ins></b> no coincide con la <b><ins>Contraseña actual.</ins></b>'
            );
            return false;
        } else {
            return true;
        }
    }

    public function cleanItems()
    {
        $this->username = null;
        $this->email = null;
        $this->dni = null;

        $this->firstname = null;
        $this->lastname = null;
        $this->gender = null;
        $this->birthdate = null;
        $this->relationship = null;
        $this->job = null;

        $this->mobile = null;
        $this->address = null;
        $this->city = null;
        $this->province = null;
        $this->region = null;
        $this->country = null;

        $this->current_password = null;
        $this->password = null;
        $this->confirm_password = null;

        $this->resetErrorBag();
        $this->resetValidation();
    }
}
