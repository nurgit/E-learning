<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Return_quz extends Model
{
    protected $fillable = [
        'return_file',
        'get_mark',
        'submitin_date',
        'quz_id',
        'status',
    ];
    use HasFactory;
}
