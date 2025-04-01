<?php

namespace App\Rules;

class RegisterRules
{
    public static function rules()
    {
      return [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
      ];
    }
}
