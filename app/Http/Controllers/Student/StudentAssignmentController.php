<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Return_assignment;

class StudentAssignmentController extends Controller
{
    public function index(){
        $data = [];
        $data['main_menu'] = "assignment";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('student.backend.assignment.index', $data);
    }


    /**
     * Store a newly created client in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */

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
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $return_assignment = new Return_assignment();
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/assets/upload/assignment', $filename);
            $return_assignment->return_file ="backend/assets/upload/assignment/$filename";

        } else {
//                return $request;
            $return_assignment->return_file = '';
        }

        $return_assignment->assignment_id = $request->idAssignment;
        $return_assignment->submitin_date = date('Y-m-d H:i:s');





        if ($return_assignment->save()) {
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
    public function download(Request $request)
    {
        $myFile = storage_path("folder/dummy_pdf.pdf");
        
        return response()->download($myFile);
    }


    public function fetch_assignment_data(Request $request)
    {

        // $get_teacher= Teacher::where('status', 1)->get();
        $data=User::where('id','=',session('LoggedUser'))-> first();

        $get_assignment= DB::table('assignments')
                    ->join('course_teachers', 'assignments.course_teacher_id', 'course_teachers.id')
                   // ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')
                    ->join('course_students', 'course_teachers.course_id', 'course_students.course_id')
                    ->join('courses', 'course_students.course_id', 'courses.id')
                    ->join('students', 'course_students.student_id', 'students.id')
                    ->where('students.email', $data->email )
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

                $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='upload_assignment_modal(\"$id\", \"$assignment_name\")' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$assignment_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


               // $action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $id);
                array_push($temp, $assignment_name);
                array_push($temp, $course_name);
                array_push($temp, $instruction);
                array_push($temp, $mark);
                array_push($temp, $date);
                array_push($temp, $edit_btn);
                array_push($temp, $delete_btn);
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
