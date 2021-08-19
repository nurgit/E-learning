<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course_student extends Model
{
    protected $fillable = [
        'course_teacher_id',
        'status',
    ];
    use HasFactory;
}
