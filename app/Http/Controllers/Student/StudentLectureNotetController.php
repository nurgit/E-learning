<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lecture_note;

class StudentLectureNotetController extends Controller
{

    public function index(){
        $data_user=User::where('id','=',session('LoggedUser'))-> first();

        $get_course= DB::table('courses')
        ->join('course_teachers', 'courses.id', 'course_teachers.course_id')
        ->join('teachers','course_teachers.teacher_id','teachers.id')
        ->where('teachers.email', $data_user->email )
        ->select('courses.course_name' ,'course_teachers.id')
        ->get();

        $data = [];
        $data['main_menu'] = "assignment";
        $data=['LoggedUserInfo'=>User::where('id','=',session('LoggedUser'))-> first()];
        return view('student.backend.lectureNote.index',compact('get_course'))->with($data);

    }



    public function fetch_notes_data(Request $request)
    {

        // $get_teacher= Teacher::where('status', 1)->get();
        $data=User::where('id','=',session('LoggedUser'))-> first();

        $get_lecture_notes= DB::table('lecture_notes')
                    ->join('course_teachers', 'lecture_notes.course_teacher_id', 'course_teachers.id')
                    ->join('courses', 'course_teachers.course_id', 'courses.id')
                    ->join('course_students','courses.id','course_students.course_id')
                    ->join('students', 'course_students.student_id', 'students.id')
                    ->where('students.email', $data->email )
                    ->select('lecture_notes.id','lecture_notes.note_name','lecture_notes.note','lecture_notes.file','lecture_notes.date','lecture_notes.course_teacher_id','lecture_notes.status','courses.course_name','lecture_notes.status')
                    ->get();
                  ( $get_lecture_notes);

        if ($get_lecture_notes->count() >0  ) {
            //dd($get_student);
            $data = [];
            foreach ($get_lecture_notes as $row) {
                
                if($row->status==1){
                    $id = $row->id;
                    $note_name = $row->note_name;
                    $note = $row->note;
                    $file = $row->file;
                    $date = $row->date;
                    $course_name = $row->course_name;
                  
                    $download_url = route('note_download', ['file_note'=>$file]);
                    $download_btn = "<a href=\"$download_url\" target=\"_blank\"><span data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-download\"></span></a>";
         
                   //$action = "$edit_btn $delete_btn";
                    $temp = array();
                    array_push($temp, $id);
                    array_push($temp, $note_name);
                    array_push($temp, $course_name);
                    array_push($temp, $note);
                    array_push($temp, $date);
                    array_push($temp, $download_btn);
    
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


