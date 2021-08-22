<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course_teacher;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Course;
class AdminCoursesController extends Controller
{
    public function index()
    {
        $data = [];
        $data['main_menu'] = "Course";
        $data['instructor'] = Teacher::get(['id', 'teacher_name']);
        $data['LoggedUserInfo'] = User::where('id','=',session('LoggedUser'))->first();
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
            'add_course_name' => 'required',
            'instructor_id' => 'required'

        ]);

        $course = new Course();
//dd($request->all());

        $course->course_name = $request->add_course_name;
        $course->course_class = "any";
        $course->save();
        $course_id = $course->id;
        $course_teacher = new Course_teacher();
        $course_teacher->course_id = $course_id;
        $course_teacher->teacher_id = $request->instructor_id;

        if ($course_teacher->save()) {
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
            'course_instructor_id' => 'required',
            'course_name' => 'required'
        ]);

        $course = Course::where('id', $request->idCourse)->get()->first();

        abort_if(!$course, 404);
        $course->course_name= $request->course_name;
        $course->course_class= "any";
        $course->save();
        $course_id = $course->id;
        $course_teacher =  Course_teacher::where('course_id',$course_id)->get()->first();
        $course_teacher->course_id = $course_id;
        $course_teacher->teacher_id = $request->course_instructor_id;


        if ($course_teacher->save()) {
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
        $course = Course::where('id', $id)->get()->first();
        $course_instructor = Course_teacher::where('course_id', $id)->get()->first();
        if ($course->count() > 0 )   {

            $course->status= 0;
            $course_instructor->status = 0 ;
            if ($course->save() && $course_instructor->save()) {
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
                $course_instructor_id = Course_teacher::where('course_id', $id)->pluck('teacher_id');
                $course_instructor = Teacher::where('id',$course_instructor_id )->pluck('teacher_name');
                
               // dd($get_course_instructor);


//                $course_class = $row->course_class;
                $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal(\"$id\", \"$course_name\",  \"$course_instructor_id\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$course_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";


                $action = "$edit_btn $delete_btn ";
                $temp = array();
                array_push($temp, $course_name);
                array_push($temp, $course_instructor);
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