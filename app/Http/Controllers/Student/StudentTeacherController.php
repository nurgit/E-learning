<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use App\Models\Course_student;
use App\Models\Student;
use App\Models\Course;

use Illuminate\Support\Facades\DB;

class StudentTeacherController extends Controller
{
    public function index(){
        $data = [];
        $data['main_menu'] = "teacher";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('student.backend.teacher.index', $data);
    }
    
    public function fetch_teacher_data(Request $request)
    {
        $data=User::where('id','=',session('LoggedUser'))-> first();
      

      
             $get_teacher= DB::table('teachers')
                    ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')
                    ->join('course_students', 'course_teachers.course_id', 'course_students.course_id')
                    ->join('courses', 'course_students.course_id', 'courses.id')
                    ->join('students', 'course_students.student_id', 'students.id')
                    ->where('students.email', $data->email )
                    ->select('teachers.teacher_name','teachers.email','courses.course_name')
                    ->get();
                   // dd( $get_teacher);



        if ($get_teacher->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_teacher as $row) {
                $course_name = $row->course_name;
                $teacher_name = $row->teacher_name;
                $teacher_email = $row->email;
                //$edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal( \"$teacher_name\",  \"$course_name\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
               // $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$teacher_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


                //$action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $course_name);
                array_push($temp, $teacher_name);
                array_push($temp, $teacher_email);
                //array_push($temp, $action);
                array_push($data, $temp);
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

