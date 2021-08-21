<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherStudentController extends Controller
{
    public function index(){
        $data = [];
        $data['main_menu'] = "student";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('teacher.backend.student.index', $data);
    }


    
    public function fetch_students_data(Request $request)
    {
        $data=User::where('id','=',session('LoggedUser'))-> first();
      
             $get_student= DB::table('students')
                    ->join('course_students', 'students.id', 'course_students.student_id')
                    ->join('courses', 'course_students.course_id', 'courses.id')
                    ->join('course_teachers', 'courses.id', 'course_teachers.course_id')
                    ->join('teachers','course_teachers.teacher_id','teachers.id')
                    ->where('teachers.email', $data->email )
                    ->select('students.id','students.student_name','courses.course_name')
                    ->get();

                   // dd($get_student);


        if ($get_student->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_student as $row) {
                $students_id = $row->id;
                $student_name = $row->student_name;
                $course_name = $row->course_name;
                
    
                $temp = array();
                array_push($temp, $students_id);
                array_push($temp, $student_name);
                array_push($temp, $course_name);
                //array_push($temp, $action);
                array_push($data, $temp);
           //dd($temp);
            }

            echo json_encode(array('data'=>$data));
        } else {
            echo '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
        }

    }
}
