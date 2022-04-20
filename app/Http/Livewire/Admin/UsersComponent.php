<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Str;

class UsersComponent extends BaseAdmin
{
    public $username;

    public $email;
    public $mobile;
    public $address;
    public $city;
    public $province;
    public $region;

    public $country;

    public $dni;
    public $firstname;
    public $lastname;
    public $gender;
    public $birthdate;
    public $relationship;
    public $job;

    public $headers = [
        'dni' => 'DNI',
        'fullname' => 'Nombres',
        'email' => 'Correo',
        'mobile' => 'Celular',
        'role' => 'Rol de usuario',
        'activated' => 'Estado',

        'not' => '',
    ];

    protected $attributes = [
        'username' => '<b><ins>Nombre de usuario</ins></b>',
        'email' => '<b><ins>Correo</ins></b>',
        'mobile' => '<b><ins>Celular</ins></b>',
        'firstname' => '<b><ins>Nombres</ins></b>',
        'lastname' => '<b><ins>Apellidos</ins></b>',
        'dni' => '<b><ins>DNI</ins></b>',
        'gender' => '<b><ins>Genero</ins></b>',
        'address' => '<b><ins>Dirección</ins></b>',
        'city' => '<b><ins>Ciudad</ins></b>',
        'province' => '<b><ins>Provincia</ins></b>',
        'region' => '<b><ins>Región</ins></b>',
        'country' => '<b><ins>Pais</ins></b>',
        'birthdate' => '<b><ins>Cumpleaños</ins></b>',
        'relationship' => '<b><ins>Estado civil</ins></b>',
        'job' => '<b><ins>Ocupación</ins></b>',
    ];
    protected $rules = [
        'username' => 'nullable',
        'email' => 'required|email|unique:users',
        'mobile' => 'required|numeric|digits:9|unique:users',
        'firstname' => 'required|min:3',
        'lastname' => 'required|min:3',
        'dni' => 'required|numeric|digits:8',
        'gender' => 'nullable',
        'address' => 'required',
        'city' => 'nullable',
        'province' => 'nullable',
        'region' => 'nullable',
        'country' => 'nullable',
        'birthdate' => 'nullable|date_format:Y-m-d',
        'relationship' => 'nullable',
        'job' => 'nullable',
    ];

    public function mount()
    {
        $this->limit = 8;
        $this->keyWord = '';

        $this->iconSort = 'fa-sort-alpha-down';
        $this->fieldSort = 'created_at';
        $this->sort = 'desc';

        $this->frame = 'index';
    }


    public function render()
    {
        $rFormat = array_diff(array_keys($this->headers), ['not', 'fullname', 'role']);
        $findIn = [];
        $table = 'users';

        foreach ($rFormat as $item) {
            $findIn[] = $table . '.' . $item;
        }

        $findIn[] = 'roles.role';

        $data['results'] = User::orderBy($this->fieldSort, $this->sort)
            ->where(function ($query) use ($findIn) {
                foreach ($findIn as $in) {
                    $query->orWhere($in, 'LIKE', '%' . $this->keyWord . '%');
                }
                $query->orWhere(DB::raw("CONCAT(firstname, ' ', lastname)"), 'LIKE', '%' . $this->keyWord . '%');
            })
            ->whereNotIn('group', [1])
            ->select($table . '.*')
            ->join('roles', 'roles.id', '=', $table . '.group')
            ->selectRaw('CONCAT(users.firstname," ",users.lastname) as fullname, roles.role')
            ->paginate($this->limit);

        $data['_title'] = 'Usuarios';

        $this->emit('refreshContent');

        return view('livewire.admin.users-component', $data)->layout('layouts.admin');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
    }

    // BEGIN DYNAMIC METHODS

    public function openFrame()
    {
        $this->frame = 'add';
        $this->emit('refreshSection');
    }

    public function saveData()
    {
        $this->validate($this->rules, [], $this->attributes);

        $data = new User();

        $data->username = Str::slug(explode(' ', $this->lastname)[0]) . $this->dni;
        $data->password = \Hash::make($this->dni);
        $data->email = $this->email;
        $data->mobile = $this->mobile;
        $data->address = $this->address;
        $data->city = $this->city;
        $data->province = $this->province;
        $data->region = $this->region;
        $data->country = $this->country;
        $data->dni = $this->dni;
        $data->firstname = $this->firstname;
        $data->lastname = $this->lastname;
        $data->gender = $this->gender;
        $data->birthdate = $this->birthdate;
        $data->relationship = $this->relationship;
        $data->job = $this->job;

//        dd($data);
        if ($data->save()) {
            $this->emit('notification', ['Se creó nuevo usuario exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $data = User::where('id', $this->itemId)->first();

        $this->email = $data->email;
        $this->mobile = $data->mobile;
        $this->address = $data->address;
        $this->city = $data->city;
        $this->province = $data->province;
        $this->region = $data->region;
        $this->country = $data->country;
        $this->dni = $data->dni;
        $this->firstname = $data->firstname;
        $this->lastname = $data->lastname;
        $this->gender = $data->gender;
        $this->birthdate = $data->birthdate;
        $this->relationship = $data->relationship;
        $this->job = $data->job;

        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {
            $rules = $this->rules;

            unset($rules['email'], $rules['mobile']);
            $rules = array_merge(['email' => 'required|email', 'mobile' => 'required|numeric'], $rules);

            $this->validate($rules, [], $this->attributes);

            $data = User::find($this->itemId);

            $data->email = $this->email;
            $data->mobile = $this->mobile;
            $data->address = $this->address;
            $data->city = $this->city;
            $data->province = $this->province;
            $data->region = $this->region;
            $data->country = $this->country;
            $data->dni = $this->dni;
            $data->firstname = $this->firstname;
            $data->lastname = $this->lastname;
            $data->gender = $this->gender;
            $data->birthdate = $this->birthdate;
            $data->relationship = $this->relationship;
            $data->job = $this->job;

            if ($data->save()) {
                $this->emit('notification', ['Usuario actualizado exitosamente']);
                $this->closeFrame();
            }
        }
    }

    public function closeFrame()
    {
        $this->frame = 'index';
        $this->cleanItems();
    }

    public function cleanItems()
    {
        $this->email = null;
        $this->mobile = null;
        $this->address = null;
        $this->city = null;
        $this->province = null;
        $this->region = null;

        $this->country = null;

        $this->dni = null;
        $this->firstname = null;
        $this->lastname = null;
        $this->gender = null;
        $this->birthdate = null;
        $this->relationship = null;
        $this->job = null;

        $this->frame = 'index';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function delete()
    {
        $data = User::find($this->deleteId);

        if ($data->delete()) {
            $this->closeFrame();
        }
    }
}
