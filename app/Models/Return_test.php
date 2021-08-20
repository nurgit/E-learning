<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_test extends Model
{
    protected $fillable = [
        'return_file',
        'get_mark',
        'submitin_date',
        'test_id',
        'status',
    ];
    use HasFactory;
}
