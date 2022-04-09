<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdministratorComponent extends BaseAdmin
{
    public $group;
    public $activated;

    public $data; //add administrator

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
        'group' => '<b><ins>Rol de usuario</ins></b>',
        'activated' => '<b><ins>Usuario activo</ins></b>',
    ];

    protected $rules = [
        'group' => 'required',
        'activated' => 'nullable',
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
            ->where('group', 2)
            ->select($table . '.*')
            ->join('roles', 'roles.id', '=', $table . '.group')
            ->selectRaw('CONCAT(users.firstname," ",users.lastname) as fullname, roles.role')
            ->paginate($this->limit);

        $data['_title'] = 'Administrador';


        $this->emit('refreshContent');

        return view('livewire.admin.administrator-component', $data)->layout('layouts.admin');
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

        $this->data = User::whereNotIn('group', [1, 2])
            ->select('users.*')
            ->selectRaw('CONCAT(users.firstname," ",users.lastname) as fullname')
            ->get();
    }

    public function saveData()
    {
        $this->validate(['itemId' => 'required'], [], ['itemId' => '<b><u>para administrador</u></b>']);

        $data = User::find($this->itemId);
        $data->group = 2;

        if ($data->save()) {
            $this->emit('notification', ['Se creó nuevo administrador exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $this->data = User::find($this->itemId);

        $this->group = $this->data->group;
        $this->activated = $this->data->activated;


        $this->emit('refreshSection');
    }

    public function updateData()
    {
        if ($this->itemId) {

            $this->validate($this->rules, [], $this->attributes);

            $data = User::find($this->itemId);

            $data->group = $this->group;
            $data->activated = $this->activated;

            if ($data->save()) {
                $this->emit('notification', ['Administrador actualizado exitosamente']);
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
        $this->data = null;
        $this->itemId = null;
        $this->activated = null;
        $this->group = null;


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
