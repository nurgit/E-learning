<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentQUZController extends Controller
{

    public function index(){
        $data = [];
        $data['main_menu'] = "assignment";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('student.backend.quz.index', $data);
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
    public function update(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required',
            'email' => 'required'
        ]);

        $teacher = Teacher::where('id', $request->idTeacher)->get()->first();
//dd($request->all());
        abort_if(!$teacher, 404);
        $teacher->teacher_name= $request->teacher_name;
        $teacher->email= $request->email;


        if ($teacher->save()) {
            return redirect()->back()->with('success', 'Teacher Modified Successfully  ');
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


    public function fetch_quz_data(Request $request)
    {

        // $get_teacher= Teacher::where('status', 1)->get();
        $data=User::where('id','=',session('LoggedUser'))-> first();

        $get_quz= DB::table('quzs')
                    ->join('course_teachers', 'quzs.course_teacher_id', 'course_teachers.id')
                   // ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')
                    ->join('course_students', 'course_teachers.course_id', 'course_students.course_id')
                    ->join('courses', 'course_students.course_id', 'courses.id')
                    ->join('students', 'course_students.student_id', 'students.id')
                    ->where('students.email', $data->email )
                    ->select('quzs.id','quzs.quz_name','quzs.instruction','quzs.file','quzs.mark','quzs.date','courses.course_name')
                    ->get();
                   // dd( $get_assignment);

        if ($get_quz->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_quz as $row) {
                $id = $row->id;
                $quz_name = $row->quz_name;
                $instruction = $row->instruction;
                $file = $row->file;
                $mark = $row->mark;
                $date = $row->date;
                $course_name = $row->course_name;

                $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal(\"$id\", \"$quz_name\",  \"$file\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$quz_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


               // $action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $id);
                array_push($temp, $quz_name);
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
