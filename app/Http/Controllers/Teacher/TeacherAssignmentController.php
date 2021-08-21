<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use App\Models\Assignment;

class TeacherAssignmentController extends Controller
{
    public function index(){
        $data_user=User::where('id','=',session('LoggedUser'))-> first();

        $get_course= DB::table('courses')
        ->join('course_teachers', 'courses.id', 'course_teachers.course_id')
        ->join('teachers','course_teachers.teacher_id','teachers.id')
        ->where('teachers.email', $data_user->email )
        ->select('courses.id','courses.course_name')
        ->get();

        $data = [];
        $data['main_menu'] = "assignment";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('teacher.backend.assignment.index',compact('get_course'))->with($data);

    }

    public function store(Request $request)
    {

        $request->validate([
            'add_teacher_name' => 'required',
            'add_email' => 'required'
        ]);

        $student = new Teacher();
//dd($request->all());

        $student->teacher_name= $request->add_teacher_name;
        $student->email= $request->add_email;

        $user = new User();
        $pass = "welcome123";
        $user->name = $request->add_teacher_name;
        $user->email = $request->add_email;
        $user->role_id= 3;
        $user->password = Hash::make($pass);


        if ($student->save() && $user->save()) {
            return redirect()->back()->with('success', 'Instructor Added Successfully  ');
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
            'add_date' => 'required',
        ]);

        $assignment = new Assignment();
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/assets/upload/assignment', $filename);
            $assignment->return_file ="backend/assets/upload/assignment/$filename";

        } else {
//                return $request;
            $assignment->return_file = '';
        }
             $assignment->assignment_name = $request->add_assignment_name;
             $assignment->course_teacher_id = $request->course_id;
             $assignment->instruction = $request->add_instruction;

             $assignment->mark = $request->add_mark;
             $assignment->date = $request->add_date;
             $assignment->date = $request->add_date;
      //  $return_assignment->assignment_id = $request->idAssignment;

        //$return_assignment->submitin_date = date('Y-m-d H:i:s');


        


        if ($assignment->save()) {
            return redirect()->back()->with('success', 'Assignment Uploded  Successfully  ');
        } else {
            return redirect()->back()->with('error', 'An error occurred! Please try again.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function delete(Request $request)
    {
        $id = $request->delete_teacher_id;

        if ($teacher = Teacher::where('id', $id)->first())   {

            $teacher->status= 0;

            if ($teacher->save()) {
                return redirect()->back()->with('success', 'Teacher Delete Succfully .');
            } else {
                return redirect()->back()->with('error', 'Teacher delete failed!');
            }
        } else {
            return redirect()->back()->with('error', 'Teacher not found!');
        }
    }


    public function fetch_assignments_data(Request $request)
    {

        // $get_teacher= Teacher::where('status', 1)->get();
        $data=User::where('id','=',session('LoggedUser'))-> first();

        $get_assignment= DB::table('assignments')
                    ->join('course_teachers', 'assignments.course_teacher_id', 'course_teachers.id')
                    ->join('courses', 'course_teachers.course_id', 'courses.id')
                    ->join('teachers', 'course_teachers.teacher_id','teachers.id' )
                   // ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')

                    ->where('teachers.email', $data->email )
                    ->select('assignments.id','assignments.assignment_name','assignments.instruction','assignments.file','assignments.mark','assignments.date','courses.course_name')
                    ->get();
                   // dd( $get_assignment);

        if ($get_assignment->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_assignment as $row) {
                $id = $row->id;
                $assignment_name = $row->assignment_name;
                $instruction = $row->instruction;
                $file = $row->file;
                $mark = $row->mark;
                $date = $row->date;
                $course_name = $row->course_name;
              
                $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='update_assignment_modal(\"$id\", \"$assignment_name\", \"$instruction\", \"$mark\", \"$date\")' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$assignment_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";
    
     
               $action = "$edit_btn $delete_btn";
                $temp = array();
                array_push($temp, $id);
                array_push($temp, $assignment_name);
                array_push($temp, $course_name);
                array_push($temp, $instruction);
                array_push($temp, $mark);
                array_push($temp, $date);
                array_push($temp, $action);

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

