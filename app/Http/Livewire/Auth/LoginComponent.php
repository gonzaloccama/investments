<?php

namespace App\Http\Livewire\Auth;

use App\Models\UsersSession;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

            if (auth()->user()->group != 1)
                $this->user_session();

            return redirect()->intended($this->redirectTo());
        }
        session()->flash('error', 'Estas credenciales no coinciden con nuestros registros.');
        return;
    }

    private function user_session()
    {
        try {
            $session = new UsersSession();

            $session->session_token = Hash::make(Carbon::today());
            $session->user_id = auth()->user()->id;
            $session->user_browser = SystemInfo::get_browsers();
            $session->user_os = SystemInfo::get_os();
            $session->user_device = SystemInfo::get_device();
            $session->user_ip = SystemInfo::get_ip();

            $session->save();
        } catch (\Exception $e) {
            $session = new UsersSession();

            $session->session_token = Hash::make(Carbon::today());
            $session->user_id = auth()->user()->id;
            $session->user_browser = 'UNKNOWN';
            $session->user_os = 'UNKNOWN';
            $session->user_device = 'UNKNOWN';
            $session->user_ip = 'UNKNOWN';

            $session->save();
        }
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
