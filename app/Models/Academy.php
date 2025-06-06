<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Academy extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
