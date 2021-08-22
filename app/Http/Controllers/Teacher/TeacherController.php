<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
class TeacherController extends Controller
{
    public function index(){
        $data = [];
        $data['LoggedUserInfo'] = User::where('id','=',session('LoggedUser'))-> first();
        $email = $data['LoggedUserInfo']->email;
        $teacher_id =  Teacher::where('email', $email)->pluck('id');
        $get_assignment= DB::table('assignments')
        ->join('course_teachers', 'assignments.course_teacher_id', 'course_teachers.id')
        ->join('courses', 'course_teachers.course_id', 'courses.id')
        ->join('teachers', 'course_teachers.teacher_id','teachers.id' )
       // ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')

        ->where('teachers.email', $email )
        ->select('assignments.id','assignments.assignment_name','assignments.instruction','assignments.file','assignments.mark','assignments.date','courses.course_name','assignments.status')
        ->get();
        $data['assignments'] = $get_assignment->count() ;
        $get_student= DB::table('students')
                    ->join('course_students', 'students.id', 'course_students.student_id')
                    ->join('courses', 'course_students.course_id', 'courses.id')
                    ->join('course_teachers', 'courses.id', 'course_teachers.course_id')
                    ->join('teachers','course_teachers.teacher_id','teachers.id')
                    ->where('teachers.email', $email )
                    ->select('students.id','students.student_name','courses.course_name')
                    ->get();
        $data['students'] = $get_student->count();
        $get_course= DB::table('courses')
                    ->join('course_teachers', 'courses.id', 'course_teachers.course_id')
                    ->join('teachers','course_teachers.teacher_id','teachers.id')
                    ->where('teachers.email', $email )
                    ->select('courses.id','courses.course_name')
                    ->get();
                    $data['courses'] = $get_course->count();
        $get_assignment= DB::table('return_assignments')
                    ->join('assignments','return_assignments.assignment_id','assignments.id')
                    ->join('course_teachers', 'assignments.course_teacher_id', 'course_teachers.id')
                    ->join('courses', 'course_teachers.course_id', 'courses.id')
                    ->join('teachers', 'course_teachers.teacher_id','teachers.id' )
                   // ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')

                    ->where('teachers.email', $email )
                    ->select('return_assignments.id','return_assignments.get_mark','return_assignments.submitin_date','return_assignments.return_file','assignments.assignment_name','assignments.instruction','assignments.file','assignments.mark','assignments.date','courses.course_name','return_assignments.status')
                    ->get();
                    $data['check_assignment'] = $get_assignment->count();
       //dd($get_course->count() );

        return view('teacher.backend.home.index', $data);
    }
}
