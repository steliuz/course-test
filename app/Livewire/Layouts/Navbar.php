<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{

    public function logout()
    {
        Auth::logout();
        $this->dispatch('showToast', 'Sesión cerrada correctamente', 'success', 3000);
        return redirect()->route('login'); 
    }

    public function render()
    {
        return view('livewire.layouts.navbar');
    }
}
