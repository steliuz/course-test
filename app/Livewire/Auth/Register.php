<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Services\AuthService;
use App\Rules\RegisterRules;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $phone;

    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function register()
    {
        $this->validate(RegisterRules::rules());

        $user = $this->authService->register($this->name, $this->email, $this->password, $this->phone);

        if ($user) {
            session()->flash('message', 'Registro y login exitoso.');
            return redirect()->route('courses.courses-availaible');
        }

        $this->addError('email', 'Hubo un problema con el registro.');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
