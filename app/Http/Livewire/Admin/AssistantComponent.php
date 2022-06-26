<?php

namespace App\Http\Livewire\Admin;

use App\Models\Office;
use App\Models\User;
use App\Models\UserOffice;
use Illuminate\Support\Facades\DB;

class AssistantComponent extends BaseAdmin
{
    public $group;
    public $activated;

    public $office_id;

    public $data; //add administrator
    public $offices; //add administrator

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
            ->where('group', 3)
            ->select($table . '.*')
            ->join('roles', 'roles.id', '=', $table . '.group')
            ->selectRaw('CONCAT(users.firstname," ",users.lastname) as fullname, roles.role')
            ->paginate($this->limit);

        $data['_title'] = 'Encargado';


        $this->emit('refreshContent');

        return view('livewire.admin.assistant-component', $data)->layout('layouts.admin');
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

        $this->data = User::whereNotIn('group', [1, 2, 3])
            ->get();

        $this->offices = Office::all();
    }

    public function saveData()
    {
        $this->validate(['itemId' => 'required'], [], ['itemId' => '<b><u>para Encargado</u></b>']);

        $data = User::find($this->itemId);
        $data->group = 3;

        if ($data->save()) {

            $this->user_office($data);

            $this->emit('notification', ['Se creó nuevo encargado exitosamente']);
            $this->closeFrame();
        }
    }

    public function edit($id = 0)
    {
        $this->frame = 'edit';
        $this->itemId = $id;

        $this->data = User::find($this->itemId);
        $this->offices = Office::all();

        $this->group = $this->data->group;
        $this->activated = $this->data->activated;

        $this->office_id = $this->data->userOffice ? $this->data->userOffice->office_id : null;

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

                if ($this->group == 3) {
                    $this->user_office($data);
                } else {
                    $data->userOffice->status = 0;
                    $data->userOffice->save();
                }

                $this->emit('notification', ['Encargado actualizado exitosamente']);
                $this->closeFrame();
            }
        }
    }

    private function user_office($data)
    {
//        dd($data->userOffice);
        if ($data->userOffice) {
            $data->userOffice->office_id = $this->office_id;
            $data->userOffice->user_id = $data->id;
            $data->userOffice->status = 1;
            $data->userOffice->save();
        } else {
            $userOffice = new UserOffice();
            $userOffice->office_id = $this->office_id;
            $userOffice->user_id = $data->id;
            $userOffice->status = 1;
            $userOffice->save();
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
        $this->offices = null;

        $this->itemId = null;
        $this->activated = null;
        $this->group = null;

        $this->office_id = null;

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
