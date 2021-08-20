<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_assignment extends Model
{
    protected $fillable = [
        'return_file',
        'get_mark',
        'teacher_comment',
        'submitin_date',
        'assignment_id',
        'status',
    ];
    use HasFactory;
}
