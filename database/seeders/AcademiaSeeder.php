<?php

namespace Database\Seeders;

use App\Models\Academy;
use Illuminate\Database\Seeder;

class AcademiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academies = Academy::create([
            'name' => 'Academia de Programación',
            'description' => 'Cursos avanzados de desarrollo web y móvil.',
            'status' => 'active',
        ]);

        $academies->courses()->createMany([
            [
                'title' => 'Curso de Laravel con Livewire',
                'description' => 'Aprende a desarrollar aplicaciones modernas.',
                'cost' => 50.00,
                'duration' => 40,
                'modality' => 'Online',
                'status' => 'active',

            ],
            [
                'title' => 'Curso de Vue.js desde Cero',
                'description' => 'Domina Vue.js y construye aplicaciones frontend.',
                'cost' => 40.00,
                'duration' => 30,
                'modality' => 'Presencial',
                'status' => 'active',

            ],
        ]);
    }
}
