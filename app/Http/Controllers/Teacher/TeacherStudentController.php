<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherStudentController extends Controller
{
    public function index(){
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('teacher.backend.student.index', $data);
    }
}
