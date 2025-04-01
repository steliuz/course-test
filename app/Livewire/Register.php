<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\AuthService;
use App\Rules\RegisterRules;

class Register extends Component
{
    public $name;
    public $email;
    public $password;

    protected $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function register()
    {
        $this->validate(RegisterRules::rules());

        $user = $this->authService->register($this->name, $this->email, $this->password);

        if ($user) {
            session()->flash('message', 'Registro y login exitoso.');
            return redirect()->route('courses-availaible');
        }

        $this->addError('email', 'Hubo un problema con el registro.');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
