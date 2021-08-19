<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminStudentController extends Controller
{

    public function index()
    {
        $data = [];
        $data['main_menu'] = "Student";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('admin.backend.student.index', $data);
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
            'name' => 'required',
            'student_email' => 'required'
        ]);

        $student = new Student();
//dd($request->all());
        
        $student->student_name= $request->name;
        $student->email= $request->student_email;

        $user = new User();
        $pass = "welcome123";
        $user->name = $request->name;
        $user->email = $request->student_email;
        $user->role_id= 2;
        $user->password = Hash::make($pass);
    

        if ($student->save() && $user->save()) {
            return redirect()->back()->with('success', 'Student Added Successfully  ');
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
            'student_name' => 'required',
            'email' => 'required'
        ]);

        $student = Student::where('id', $request->idstudentes)->get()->first();
//dd($request->all());
        abort_if(!$student, 404);
        $student->student_name= $request->student_name;
        $student->email= $request->email;
    

        if ($student->save()) {
            return redirect()->back()->with('success', 'Student Modified Successfully  ');
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
        $id = $request->delete_student_id;

        if ($student = Student::where('id', $id)->first())   {

            $student->status= 0;

            if ($student->save()) {
                return redirect()->back()->with('success', 'Student Delete Succfully .');
            } else {
                return redirect()->back()->with('error', 'Student delete failed!');
            }
        } else {
            return redirect()->back()->with('error', 'Student not found!');
        }
    }

    
    public function fetch_student_data(Request $request)
    {

        $get_student = Student::where('status', 1)->get();

        if ($get_student->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_student as $row) {
                $id = $row->id;
                $name = $row->student_name;
                $email = $row->email ;
                $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal(\"$id\", \"$name\",  \"$email\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


                $action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $name);
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
