<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        User::factory(5)->create(['role' => 'father']);

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('password123'),
            'phone' => '1234567890',
        ]);
    }
}
