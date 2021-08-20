<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminInstructorController extends Controller
{
    public function index()
    {
        $data = [];
        $data['main_menu'] = "instructor";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('admin.backend.instructor.index', $data);
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
        $user->role_id= 2;
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

    
    public function fetch_teacher_data(Request $request)
    {

        $get_teacher= Teacher::where('status', 1)->get();
//dd($get_teacher);
            //$get_courae=Course::get();

        if ($get_teacher->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_teacher as $row) {
                $id = $row->id;
                $teacher_name = $row->teacher_name;
                $email = $row->email;
                $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal(\"$id\", \"$teacher_name\",  \"$email\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$teacher_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


                $action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $teacher_name);
                array_push($temp, $email);
                array_push($temp, $email);
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
