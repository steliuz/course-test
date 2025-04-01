<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Academy;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academies = Academy::all();

        foreach ($academies as $academy) {
            Course::factory(5)->create([
                'academy_id' => $academy->id,
            ]);
        }
    }
}
