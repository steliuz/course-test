<?php

namespace App\Rules;

class LoginRules
{
    public static function rules()
    {
      return [
        'email' => 'required|email',
        'password' => 'required',
      ];
    }
}
