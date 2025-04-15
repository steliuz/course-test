<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\AuthService;
use App\Rules\LoginRules;

class Login extends Component
{
    public $email;
    public $password;

    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login()
    {
        $this->validate(LoginRules::rules());

        if ($this->authService->login($this->email, $this->password)) {
            $this->dispatch('showToast', 'Bienvenido de nuevo', 'success', 3000);
            return redirect()->route('home');

        }

        $this->addError('email', 'Credenciales incorrectas.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
