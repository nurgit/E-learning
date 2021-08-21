<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;

class TeacherCourseController extends Controller
{
    public function index(){
        $data = [];
        $data['main_menu'] = "courses";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('teacher.backend.course.index', $data);
    }
    
    public function fetch_courses_data(Request $request)
    {
        $data=User::where('id','=',session('LoggedUser'))-> first();
      
             $get_course= DB::table('courses')
                    ->join('course_teachers', 'courses.id', 'course_teachers.course_id')
                    ->join('teachers','course_teachers.teacher_id','teachers.id')
                    ->where('teachers.email', $data->email )
                    ->select('courses.id','courses.course_name')
                    ->get();


        if ($get_course->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_course as $row) {
                $course_id = $row->id;
                $course_name = $row->course_name;
                
               
                
                //$edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal( \"$teacher_name\",  \"$course_name\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
               // $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$teacher_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


                //$action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $course_id);
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


