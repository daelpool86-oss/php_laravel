<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    /** @use HasFactory<\Database\Factories\CoursesFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'teacher',
        'genre',
        'duration',
        'enrolment_key',
        'capacity',
        'place',
        'is_active'
    ];
    protected $casts = [
       'is_active' => 'boolean',
       
    ];
}
