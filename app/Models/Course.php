<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Academy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'cost',
        'duration',
        'modality',
        'status',
        'academy_id'
    ];

    public function academy()
    {
        return $this->belongsTo(Academy::class, 'academy_id');
    }
}
