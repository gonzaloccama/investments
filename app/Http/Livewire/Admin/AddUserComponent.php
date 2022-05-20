<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Livewire\Component;
use Str;

class AddUserComponent extends Component
{
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

    public $disable_read;

    protected $attributes = [
//        'username' => '<b><ins>Nombre de usuario</ins></b>',
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
//        'username' => 'nullable',
        'email' => 'required|email|unique:users',
        'mobile' => 'required|numeric|digits:9',
        'firstname' => 'required|min:3',
        'lastname' => 'required|min:3',
        'dni' => 'required|numeric|digits:8|unique:users',
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

    public function render()
    {
        $this->dispatchBrowserEvent('childRefresh');
        return view('livewire.admin.add-user-component');
    }

    public function updated($property)
    {
        $this->validateOnly($property, $this->rules, [], $this->attributes);
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
        $data->firstname = mb_convert_case($this->firstname, MB_CASE_TITLE, "UTF-8");
        $data->lastname = mb_convert_case($this->lastname, MB_CASE_TITLE, "UTF-8");
        $data->gender = $this->gender;
        $data->birthdate = $this->birthdate;
        $data->relationship = $this->relationship;
        $data->job = $this->job;

        if ($data->save()) {
            $this->emitUp('custom', [$this->dni, $data->id]);
            $this->emitUp('closeModal');
            $this->emit('notification', ['Se creó nuevo usuario exitosamente']);

            $this->cleanItems();
        }
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

        $this->disable_read = false;

        $this->resetErrorBag();
        $this->resetValidation();
    }

    /*** begin search data ***/
    public function searchData()
    {
        $this->validate(['dni' => 'required|numeric|digits:8',], [], $this->attributes);
        $data = [];
        if ($this->dni) {
            $data = $this->getDNI($this->dni);
            if ($data && $data->Nombre != '' && $data->Paterno != '') {
                $this->firstname = mb_convert_case($data->Nombre, MB_CASE_TITLE, "UTF-8");
                $this->lastname = mb_convert_case($data->Paterno . ' ' . $data->Materno, MB_CASE_TITLE, "UTF-8");

                $this->disable_read = true;
            }else{
                $this->firstname = null;
                $this->lastname = null;
                $this->disable_read = false;
                $this->addError(
                    'dni',
                    '<b><ins>DNI</ins></b>, sin resultados de busqueda <b><ins>¡edite los campos!.</ins></b>'
                );
            }
        }
    }

    private function getDNI($id)
    {
        $client = new Client(['verify' => false]);
        try {
            $response = $client
                ->get('https://www.facturacionelectronica.us/' .
                    'facturacion/controller/ws_consulta_rucdni_v2.php?documento=' .
                    'DNI&usuario=10447915125&password=985511933&nro_documento=' . $id)
                ->getBody();
            return json_decode($response)->result;
        } catch (RequestException $e) {
            $this->addError(
                'dni',
                'En la <b><ins>busqueda del DNI</ins></b> algo salió mal.'
            );
            return null;
        }
    }
    /*** end search data ***/
}
