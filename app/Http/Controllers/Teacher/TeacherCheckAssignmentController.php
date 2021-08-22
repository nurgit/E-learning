<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Return_assignment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TeacherCheckAssignmentController extends Controller
{
    //
    public function index(){
        $data_user=User::where('id','=',session('LoggedUser'))-> first();

        $data = [];
        $data['main_menu'] = "assignment";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('teacher.backend.checkAssignment.index')->with($data);

    }

    public function update(Request $request)
    {
        $request->validate([
            'get_mark' => 'required',
          
         
          
        ]);
     

        $assignment =Return_assignment::where('id',$request->idAssignment)->get()->first();;
       
            

             $assignment->get_mark = $request->get_mark;


        


        if ($assignment->save()) {
            return redirect()->back()->with('success', 'Assignment update  Successfully  ');
        } else {
            return redirect()->back()->with('error', 'An error occurred! Please try again.');
        }
    }


    public function upload(Request $request)
    {
        $request->validate([
            'add_assignment_name' => 'required',
            'course_id' => 'required',
            'add_instruction' => 'required',
            'add_mark' => 'required',
            'add_date' => 'required',
            'file' => 'required',
        ]);

        $assignment = new Assignment();
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/assets/upload/assignment', $filename);
            $assignment->file ="backend/assets/upload/assignment/$filename";

        } else {
//                return $request;
            $assignment->file ='';
        }
             $assignment->assignment_name = $request->add_assignment_name;
             $assignment->course_teacher_id = $request->course_id;
             $assignment->instruction = $request->add_instruction;

             $assignment->mark = $request->add_mark;
             $assignment->date = $request->add_date;
      //  $return_assignment->assignment_id = $request->idAssignment;

        //$return_assignment->submitin_date = date('Y-m-d H:i:s');


        


        if ($assignment->save()) {
            return redirect()->back()->with('success', 'Assignment Uploded  Successfully  ');
        } else {
            return redirect()->back()->with('error', 'An error occurred! Please try again.');
        }
    }
  


    public function delete(Request $request)
    {


        if ( $assignment =Assignment::where('id',$request->assignmentId)->get()->first())   {

            $assignment->status= 0;

            if ($assignment->save()) {
                return redirect()->back()->with('success', 'Assignment Delete Succfully .');
            } else {
                return redirect()->back()->with('error', 'Assignment delete failed!');
            }
        } else {
            return redirect()->back()->with('error', 'Assignment not found!');
        }
    }


    public function fetch_check_assignments_data(Request $request)
    {

        // $get_teacher= Teacher::where('status', 1)->get();
        $data=User::where('id','=',session('LoggedUser'))-> first();

        $get_assignment= DB::table('return_assignments')
                    ->join('assignments','return_assignments.assignment_id','assignments.id')
                    ->join('course_teachers', 'assignments.course_teacher_id', 'course_teachers.id')
                    ->join('courses', 'course_teachers.course_id', 'courses.id')
                    ->join('teachers', 'course_teachers.teacher_id','teachers.id' )
                   // ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')

                    ->where('teachers.email', $data->email )
                    ->select('return_assignments.id','return_assignments.get_mark','return_assignments.submitin_date','assignments.assignment_name','assignments.instruction','assignments.file','assignments.mark','assignments.date','courses.course_name','return_assignments.status')
                    ->get();

        if ($get_assignment->count() >0  ) {
            //dd($get_student);
            $data = [];
            foreach ($get_assignment as $row) {
                
                if($row->status==1){
                    $id = $row->id;

                    $assignment_name = $row->assignment_name;
                    $instruction = $row->instruction;
                    $file = $row->file;
                    $mark = $row->mark;
                    $get_mark=$row->get_mark;
                    $date = $row->date;
                    $submitin_date = $row->submitin_date;
                    $course_name = $row->course_name;
                  
                    $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='update_assignment_modal(\"$id\", \"$assignment_name\", \"$instruction\", \"$mark\",\"$get_mark\", \"$date\",\"$submitin_date\")' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                    $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$assignment_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";
        
         
                   $action = "$edit_btn $delete_btn";
                    $temp = array();
                    array_push($temp, $id);
                    array_push($temp, $assignment_name);
                    array_push($temp, $course_name);
                    array_push($temp, $instruction);
                    array_push($temp, $mark);
                    array_push($temp, $get_mark);
                    array_push($temp, $date);
                    array_push($temp, $submitin_date);
                    array_push($temp, $file);
                    array_push($temp, $edit_btn);
    
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


