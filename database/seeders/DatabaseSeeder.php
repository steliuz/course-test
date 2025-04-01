<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'phone' => '1234567890',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Father User',
            'email' => 'father@example.com',
            'password' => bcrypt('password'),
            'phone' => '0987654321',
            'role' => 'father',
        ]);

        $this->call([
            UserSeeder::class,
            AcademySeeder::class,
            CourseSeeder::class,
            StudentSeeder::class,
            EnrollmentSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
