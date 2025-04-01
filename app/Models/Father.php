<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'password', 'role'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
