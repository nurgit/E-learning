<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
class AdminCoursesController extends Controller
{
    public function index()
    {
        $data = [];
        $data['main_menu'] = "Course";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('admin.backend.courses.index', $data);
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
            'add_course_class' => 'required',
            'add_course_name' => 'required'
        ]);

        $course = new Course();
//dd($request->all());
        
        $course->course_name= $request->add_course_name;
        $course->course_class= $request->add_course_class;

        if ($course->save()) {
            return redirect()->back()->with('success', 'Course Added Successfully  ');
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
            'course_class' => 'required',
            'course_name' => 'required'
        ]);

        $course = Course::where('id', $request->idCourse)->get()->first();

        abort_if(!$course, 404);
        $course->course_name= $request->course_name;
        $course->course_class= $request->course_class;
    

        if ($course->save()) {
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
        $id = $request->delete_course_id;

        if ($course = Course::where('id', $id)->first())   {

            $course->status= 0;

            if ($course->save()) {
                return redirect()->back()->with('success', 'Course Delete Succfully .');
            } else {
                return redirect()->back()->with('error', 'Course delete failed!');
            }
        } else {
            return redirect()->back()->with('error', 'Course not found!');
        }
    }

    
    public function fetch_courses_data(Request $request)
    {

        $get_course= Course::where('status', 1)->get();

        if ($get_course->count() > 0) {
            //dd($get_student);
            $data = [];
            foreach ($get_course as $row) {
                $id = $row->id;
                $course_name = $row->course_name;
                $course_class = $row->course_class;
                $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal(\"$id\", \"$course_name\",  \"$course_class\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$course_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


                $action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $course_name);
                array_push($temp, $course_class);
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
