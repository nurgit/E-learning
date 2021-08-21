<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class AdminController extends Controller
{
    public function index(){
        $data = [];
        $data['LoggedUserInfo'] = User::where('id','=',session('LoggedUser'))-> first();
        $data['students'] = Student::where('status', 1)->count();
        $data['instructors'] = Teacher::where('status', 1)->count();
        $data['courses'] = Course::where('status', 1)->count();
        $data['tutorials'] = Tutorial::where('status', 1)->count();
        return view('admin.backend.home.index', $data);
    }
}
