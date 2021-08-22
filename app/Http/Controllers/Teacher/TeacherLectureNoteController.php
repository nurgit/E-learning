<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Assignment;
use App\Models\Lecture_note;



class TeacherLectureNoteController extends Controller
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
        return view('teacher.backend.lectureNote.index',compact('get_course'))->with($data);

    }

    public function update(Request $request)
    {
        $request->validate([
            'note_name' => 'required',
  
          
        ]);
     

        $lecture_notes =Lecture_note::where('id',$request->idLectureNote)->get()->first();;
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/assets/upload/assignment', $filename);
            $lecture_notes->file ="backend/assets/upload/assignment/$filename";

        } else {
//                return $request;
            $lecture_notes->file =$request->p_file;
        }
             $lecture_notes->note_name = $request->note_name;
            // $assignment->course_teacher_id = $request->course_id;
             $lecture_notes->note = $request->note;

      
      //  $return_assignment->assignment_id = $request->idAssignment;

        //$return_assignment->submitin_date = date('Y-m-d H:i:s');


        


        if ($lecture_notes->save()) {
            return redirect()->back()->with('success', 'Lecture Note update  Successfully  ');
        } else {
            return redirect()->back()->with('error', 'An error occurred! Please try again.');
        }
    }


    public function upload(Request $request)
    {
        $request->validate([
            'add_note_name' => 'required',
            'course_id' => 'required',

        ]);

        $lecture_note = new Lecture_note();
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('backend/assets/upload/assignment', $filename);
            $lecture_note->file ="backend/assets/upload/assignment/$filename";

        } else {
//                return $request;
            $lecture_note->file ='';
        }
             $lecture_note->note_name = $request->add_note_name;
             $lecture_note->course_teacher_id = $request->course_id;

             $lecture_note->note = $request->add_note;
             $lecture_note->date = date("Y/m/d H:i:s") ;
      //  $return_assignment->assignment_id = $request->idAssignment;

        //$return_assignment->submitin_date = date('Y-m-d H:i:s');


        


        if ($lecture_note->save()) {
            return redirect()->back()->with('success', 'Lecture Uploded  Successfully  ');
        } else {
            return redirect()->back()->with('error', 'An error occurred! Please try again.');
        }
    }
  


    public function delete(Request $request)
    {


        if ( $lecture_note =Lecture_note::where('id',$request->dlt_idLectureNote)->get()->first())   {

            $lecture_note->status= 0;

            if ($lecture_note->save()) {
                return redirect()->back()->with('success', 'Lecture Note  Delete Succfully .');
            } else {
                return redirect()->back()->with('error', 'Lecture Note delete failed!');
            }
        } else {
            return redirect()->back()->with('error', 'Lecture Note  not found!');
        }
    }


    public function fetch_lecture_notes_data(Request $request)
    {

        // $get_teacher= Teacher::where('status', 1)->get();
        $data=User::where('id','=',session('LoggedUser'))-> first();

        $get_lecture_notes= DB::table('lecture_notes')
                    ->join('course_teachers', 'lecture_notes.course_teacher_id', 'course_teachers.id')
                    ->join('courses', 'course_teachers.course_id', 'courses.id')
                    ->join('teachers', 'course_teachers.teacher_id','teachers.id' )
                   // ->join('course_teachers', 'teachers.id', 'course_teachers.teacher_id')

                    ->where('teachers.email', $data->email )
                    ->select('lecture_notes.id','lecture_notes.note_name','lecture_notes.note','lecture_notes.file','lecture_notes.date','lecture_notes.course_teacher_id','lecture_notes.status','courses.course_name','lecture_notes.status')
                    ->get();
                   // dd( $get_assignment);

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
                  
                    $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='update_LectureNite_modal(\"$id\", \"$note_name\", \"$note\", \"$date\",\"$file\")' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                    $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$note_name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";
        
         
                   $action = "$edit_btn $delete_btn";
                    $temp = array();
                    array_push($temp, $id);
                    array_push($temp, $note_name);
                    array_push($temp, $course_name);
                    array_push($temp, $note);
                    array_push($temp, $date);
                    array_push($temp, $action);
    
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

