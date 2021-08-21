<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course_teacher;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Course;

class AdminTutorialController extends Controller
{
    public function index()
    {
        $data = [];
        $data['main_menu'] = "Tutorial";
        //$data['instructor'] = Teacher::get(['id', 'teacher_name']);
        $data['LoggedUserInfo'] = User::where('id','=',session('LoggedUser'))->first();
        return view('admin.backend.tutorial.index', $data);
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
            'add_tutorial_name' => 'required',
            'add_sbject_name' => 'required',
            'tutorial_file' => 'required'

        ]);

        $tutorial = new Tutorial();
//dd($request->all());

        $tutorial->tutorial_name = $request->add_tutorial_name;
        $tutorial->subject = $request->add_sbject_name;
        $tutorial->date = date('Y-m-d H:i:s');
        $data = User::where('id','=',session('LoggedUser'))-> first();
        $tutorial->admin_id = $data->id;
        if ($request->hasfile('tutorial_file')) {
            $file = $request->file('tutorial_file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/assets/upload/tutorial', $filename);
            $tutorial->link ="backend/assets/upload/tutorial/$filename";

        } else {
//                return $request;
            $tutorial->link = '';
        }

        if (  $tutorial->save() ) {
            return redirect()->back()->with('success', 'Tutorial Added Successfully  ');
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
            'update_tutorial_name' => 'required',
            'update_subject_name' => 'required',
            'update_tutorial_file' => 'required'
        ]);
        //dd( $request->upadte_tutorial_file);

        $tutorial = Tutorial::where('id', $request->idTutorial)->get()->first();

        abort_if(!$tutorial, 404);
        $tutorial->tutorial_name = $request->update_tutorial_name;
        $tutorial->subject = $request->update_subject_name;
        $tutorial->date = date('Y-m-d H:i:s');
        $data = User::where('id','=',session('LoggedUser'))-> first();
        $tutorial->admin_id = $data->id;
        if ($request->hasfile('update_tutorial_file')) {
            $file = $request->file('update_tutorial_file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/assets/upload/tutorial', $filename);
            $tutorial->link ="backend/assets/upload/tutorial/$filename";

        } else {
//                return $request;
            $tutorial->link = '';
        }

        if ($tutorial->save()) {
            return redirect()->back()->with('success', 'Course Modified Successfully  ');
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
        $id = $request->delete_tutorial_id;
        $tutorial = Tutorial::where('id', $id)->get()->first();
        $tutorial_instructor = Tutorial::where('id', $id)->get()->first();
        if ($tutorial->count() > 0 )   {

            $tutorial->status= 0;
            $tutorial_instructor->status = 0 ;
            if ($tutorial->save() ) {
                return redirect()->back()->with('success', 'Course Delete Succfully .');
            } else {
                return redirect()->back()->with('error', 'Course delete failed!');
            }
        } else {
            return redirect()->back()->with('error', 'Course not found!');
        }
    }


    public function fetch_tutorials_data(Request $request)
    {

        $get_tutorial = Tutorial::where('status', 1)->get();

        if ($get_tutorial->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_tutorial as $row) {
                $id = $row->id;
                $tutorial_name = $row->tutorial_name;
                $subject = $row->subject;
                $date = $row->date;
                $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal(\"$id\", \"$tutorial_name\",  \"$subject\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$tutorial_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


                $action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $id);
                array_push($temp, $tutorial_name);
                array_push($temp, $subject);
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
