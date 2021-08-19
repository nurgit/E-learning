<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_teacher extends Model
{
    protected $fillable = [
        'course_id',
        'teacher_id',
        'status',
    ];
    use HasFactory;
}
