<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegistationController;

use App\Http\Controllers\HomeController;
//Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminCoursesController;
use App\Http\Controllers\Admin\AdminInstructorController;
use App\Http\Controllers\Admin\AdminTutorialController;
//student
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentTeacherController;
use App\Http\Controllers\Student\StudentAssignmentController;
use App\Http\Controllers\Student\StudentQUZController;
use App\Http\Controllers\Student\StudentTestController;
use App\Http\Controllers\Student\StudentAllResultController;
use App\Http\Controllers\Student\StudentLectureNotetController;
//Teacher
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TeacherCourseController;
use App\Http\Controllers\Teacher\TeacherStudentController;
use App\Http\Controllers\Teacher\TeacherAssignmentController;
use App\Http\Controllers\Teacher\TeacherQUZController;
use App\Http\Controllers\Teacher\TeacherTestController;
use App\Http\Controllers\Teacher\TeacherLectureNoteController;
use App\Http\Controllers\Teacher\TeacherCheckAssignmentController;


use App\Http\Controllers\Auth\LoginController;

use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('auth/login');
//});

//###################################



Route::get('/', [HomeController::class,'index']);

Route::get('/registation',[RegistationController::class, 'registation'])->name('registation');
Route::post('/create',[RegistationController::class, 'create'])->name('create');

Route::get('/login', [LoginController::class, 'get_login'])->name('login');
Route::post('/loginCheck',[LoginController::class, 'loginCheck'])->name('loginCheck');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::group([ 'prefix'=>'admin' ], function(){
    Route::get('/',[AdminController::class,'index'])->name('admin.dashboard');
    //courses
    Route::get('courses',[AdminCoursesController::class,'index'])->name('admin.courses');
    Route::post('course_store',[AdminCoursesController::class,'store']);
    Route::post('course_update',[AdminCoursesController::class,'update']);
    Route::post('course_delete',[AdminCoursesController::class,'delete']);
    //student
    Route::get('student',[AdminStudentController::class,'index']);
    Route::post('student_store',[AdminStudentController::class,'store']);
    Route::post('student_update',[AdminStudentController::class,'update']);
    Route::post('student_delete',[AdminStudentController::class,'delete']);
    //instructor
    Route::get('instructor',[AdminInstructorController::class,'index'])->name('admin.instructor');
    Route::post('teacher_store',[AdminInstructorController::class,'store']);
    Route::post('teacher_update',[AdminInstructorController::class,'update']);
    Route::post('teacher_delete',[AdminInstructorController::class,'delete']);
    //Tutorial
    Route::get('tutorial',[AdminTutorialController::class,'index'])->name('admin.tutorial');
    Route::post('tutorial_store',[AdminTutorialController::class,'store']);
    Route::post('tutorial_update',[AdminTutorialController::class,'update']);
    Route::post('tutorial_delete',[AdminTutorialController::class,'delete']);
    //Fatch
    Route::post('/get_student_data', [AdminStudentController::class, 'fetch_student_data']);
    Route::post('/get_courses_data', [AdminCoursesController::class, 'fetch_courses_data']);
    Route::post('/get_tutorials_data', [AdminTutorialController::class, 'fetch_tutorials_data']);
    Route::post('/get_teacher_data', [AdminInstructorController::class, 'fetch_teacher_data']);

});


//Student Group
Route::group([ 'prefix'=>'student', 'middleware'=>['authCheck']], function(){
    Route::get('dashboard',[StudentController::class,'index'])->name('student.dashboard');

    //Teacher
    Route::get('teacher',[StudentTeacherController::class,'index']);

    //Assignment
    Route::get('assignment',[StudentAssignmentController::class,'index']);
    Route::post('assignment_upload',[StudentAssignmentController::class,'upload']);
//    Route::post('assignment_download',[StudentAssignmentController::class,'download']);

    //Quz
    Route::get('quz',[StudentQUZController::class,'index']);

    //test
     Route::get('test',[StudentTestController::class,'index']);

    //All Resul

    Route::get('allResult',[StudentAllResultController::class,'index']);

    // Recture Note
    Route::get('lectureNote',[StudentLectureNotetController::class,'index']);

    //Fatch
    Route::post('/get_teacher_data', [StudentTeacherController::class, 'fetch_teacher_data']);
    Route::post('/get_assignment_data', [StudentAssignmentController::class, 'fetch_assignment_data']);
    Route::post('/get_quz_data', [StudentQUZController::class, 'fetch_quz_data']);
    Route::post('/get_notes_data', [StudentLectureNotetController::class,'fetch_notes_data']);

    

});

//Teacher Group
Route::group([ 'prefix'=>'teacher', 'middleware'=>['authCheck']], function(){
    Route::get('dashboard',[TeacherController::class,'index'])->name('teacher.dashboard');
    //course
    Route::get('course',[TeacherCourseController::class,'index']);

    //Student
    Route::get('student',[TeacherStudentController::class,'index']);

    //Assingment
    Route::get('assignment',[TeacherAssignmentController::class,'index']);
    Route::post('assignment_uoload',[TeacherAssignmentController::class,'upload']);
    Route::post('assignment_update',[TeacherAssignmentController::class,'update']);

    Route::post('assignment_delete',[TeacherAssignmentController::class,'delete']);

    //Check Assignment
    Route::get('checkAssignment',[TeacherCheckAssignmentController::class,'index']);
    Route::post('return_assignments_marking',[TeacherCheckAssignmentController::class,'update']);
    
    //QUZ
    Route::get('quz',[TeacherQUZController::class,'index']);
    //Test
    Route::get('test',[TeacherTestController::class,'index']);

    //Lecture Note
    Route::get('lectureNote',[TeacherLectureNoteController::class,'index']);
    Route::post('lectureNote_uoload',[TeacherLectureNoteController::class,'upload']);
    Route::post('lectureNote_update',[TeacherLectureNoteController::class,'update']);
    Route::post('lectureNote_delete',[TeacherLectureNoteController::class,'delete']);

    //Fatch
    Route::post('/get_courses_data', [TeacherCourseController::class, 'fetch_courses_data']);
    Route::post('/get_students_data', [TeacherStudentController::class, 'fetch_students_data']);
    Route::post('/get_assignments_data', [TeacherAssignmentController::class, 'fetch_assignments_data']);
    Route::post('/get_check_assignments_data', [TeacherCheckAssignmentController::class, 'fetch_check_assignments_data']);

    Route::post('/get_lecture_notes_data', [TeacherLectureNoteController ::class, 'fetch_lecture_notes_data']);
    

});
    
    // download routing 
    Route::get('{file}', [StudentAssignmentController::class, 'download'])->name('download');
    Route::get('{file_assignment}', [TeacherCheckAssignmentController::class, 'download'])->name('check_assignment_download');
    Route::get('{file_note}', [StudentAssignmentController::class, 'download'])->name('note_download');




