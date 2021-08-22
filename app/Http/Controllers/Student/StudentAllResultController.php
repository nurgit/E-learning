<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentAllResultController extends Controller
{

    
    public function index(){
        $data_user=User::where('id','=',session('LoggedUser'))-> first();



        $data = [];
        $data['main_menu'] = "assignment";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('student.backend.allResult.index')->with($data);

    }



 
    public function fetch_result_data(Request $request)
    {

        // $get_teacher= Teacher::where('status', 1)->get();
        $data=User::where('id','=',session('LoggedUser'))-> first();


    
    
        $get_assignment= DB::table('return_assignments')
                    ->join('assignments','return_assignments.assignment_id','assignments.id')
                    ->join('course_teachers', 'assignments.course_teacher_id', 'course_teachers.id')
                    ->join('course_students', 'course_teachers.course_id', 'course_students.course_id')
                    ->join('courses', 'course_students.course_id', 'courses.id')
                    ->join('students', 'course_students.student_id', 'students.id')
                    ->where('students.email', $data->email )
                    ->select('return_assignments.id','return_assignments.get_mark','return_assignments.submitin_date','return_assignments.return_file','assignments.assignment_name','assignments.instruction','assignments.mark','assignments.date','courses.course_name','return_assignments.status')
                    ->get();
                   // dd( $get_assignment);

        if ($get_assignment->count() >0  ) {
         
            $data = [];
            foreach ($get_assignment as $row) {
                
                if($row->status==1){

                    $id = $row->id;
                    $assignment_name = $row->assignment_name;
                    $instruction = $row->instruction;
             
                    $mark = $row->mark;
                    $get_mark=$row->get_mark;
                    $date = $row->date;
                    $submitin_date = $row->submitin_date;
                    $course_name = $row->course_name;
                    $temp = array();
                    array_push($temp, $id);
                    array_push($temp, $assignment_name);
                    array_push($temp, $course_name);
                    array_push($temp, $instruction);
                    array_push($temp, $date);
                    array_push($temp, $submitin_date);
                    array_push($temp, $mark);
                    array_push($temp, $get_mark);

    
                    array_push($data, $temp);
                    
                }
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


