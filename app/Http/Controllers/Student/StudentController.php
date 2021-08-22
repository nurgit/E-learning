<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use App\Models\Student;
use App\Models\Course_student;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(){
        $data = [];
        $data['LoggedUserInfo'] = User::where('id','=',session('LoggedUser'))-> first();
        $email = $data['LoggedUserInfo']->email;
        $student_id =  Student::where('email', $email)->pluck('id');
 //dd($student_id);
        $data['courses'] = Course_student::where('student_id', $student_id)->count();
        $get_assignment= DB::table('assignments')
        ->join('course_teachers', 'assignments.course_teacher_id', 'course_teachers.id')
       // ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')
        ->join('course_students', 'course_teachers.course_id', 'course_students.course_id')
        ->join('courses', 'course_students.course_id', 'courses.id')
        ->join('students', 'course_students.student_id', 'students.id')
        ->where('students.email', $email )
        ->select('assignments.id','assignments.assignment_name','assignments.instruction','assignments.file','assignments.mark','assignments.date','courses.course_name')
        ->get();
        $data['assignment'] = $get_assignment->count();
        $get_lecture_notes= DB::table('lecture_notes')
                    ->join('course_teachers', 'lecture_notes.course_teacher_id', 'course_teachers.id')
                    ->join('courses', 'course_teachers.course_id', 'courses.id')
                    ->join('course_students','courses.id','course_students.course_id')
                    ->join('students', 'course_students.student_id', 'students.id')
                    ->where('students.email', $email )
                    ->select('lecture_notes.id','lecture_notes.note_name','lecture_notes.note','lecture_notes.file','lecture_notes.date','lecture_notes.course_teacher_id','lecture_notes.status','courses.course_name','lecture_notes.status')
                    ->get();
                    $data['lectures'] = $get_lecture_notes->count();
        // $data['students'] = Student::where('status', 1)->count();
        // $data['instructors'] = Teacher::where('status', 1)->count();
       
        // $data['tutorials'] = Tutorial::where('status', 1)->count();
        return view('student.backend.home.index', $data);
    }
}
