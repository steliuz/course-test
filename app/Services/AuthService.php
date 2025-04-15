<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
    public function login($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            session()->regenerate();
            return true;
        }

        return false;
    }

    public function register($name, $email, $password, $phone)
    {
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'father',
            'phone' => $phone
        ]);

        Auth::login($user);
        session()->regenerate();
        return $user;
    }
}
