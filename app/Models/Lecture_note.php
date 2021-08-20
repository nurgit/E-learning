<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture_note extends Model
{
    protected $fillable = [
        'note_name',
        'note',
        'file',
        'mark',
        'date',
        'Course_teacher_id',
        'status',
    ];
    use HasFactory;
}
