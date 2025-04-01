<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        $links = [
            ['route' => 'home', 'label' => 'Inicio', 'role' => 'all'],
            ['route' => 'academies.index', 'label' => 'Gestión de Academias y Cursos', 'role' => 'admin'],
            ['route' => 'students.index', 'label' => 'Gestión de Estudiantes', 'role' => 'father'],
            ['route' => 'enrollments.index', 'label' => 'Gestión de Matrículas', 'role' => 'admin'],
            ['route' => 'messages.index', 'label' => 'Notificaciones', 'role' => 'admin'],
        ];

        return view('livewire.layouts.sidebar', compact('links'));
    }
}
