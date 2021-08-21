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
    Route::post('assignment_uoload',[StudentAssignmentController::class,'upload']);
   
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
    
    //QUZ
    Route::get('quz',[TeacherQUZController::class,'index']);
    //Test
    Route::get('test',[TeacherTestController::class,'index']);

    //Lecture Note
    Route::get('lectureNote',[TeacherLectureNoteController::class,'index']);

    //Fatch
    Route::post('/get_courses_data', [TeacherCourseController::class, 'fetch_courses_data']);
    Route::post('/get_students_data', [TeacherStudentController::class, 'fetch_students_data']);
    Route::post('/get_assignments_data', [TeacherAssignmentController::class, 'fetch_assignments_data']);
    
    
});

//######################################################
// Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'get_login'])->name('login');
// Route::post('/post_login',[App\Http\Controllers\Auth\LoginController::class, 'post_login']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);

// Route::group(['middleware'=> 'auth'], function() {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
//     Route::post('/home/store_payment', [App\Http\Controllers\HomeController::class, 'store_payment']);
//     // Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
//     Route::get('/session', function(){
// //        dd(Request::session());
//     });
// });

// Route::prefix('clients')->group(function (){
//     Route::get('/', [App\Http\Controllers\ClientController::class, 'index']);
//     Route::post('/store', [App\Http\Controllers\ClientController::class, 'store']);
//     Route::post('/update', [App\Http\Controllers\ClientController::class, 'update']);
//     Route::post('/delete', [App\Http\Controllers\ClientController::class, 'delete']);
//     Route::get('/{client}/client_sale', [App\Http\Controllers\ClientController::class, 'client_sales'])->name('client_sale');
//     Route::post('/get_client_data', [App\Http\Controllers\ClientController::class, 'fetch_client_data']);
// });
// Route::prefix('inventory')->group(function (){
//     Route::get('/', [App\Http\Controllers\InventoryController::class, 'index']);
//     Route::post('/store', [App\Http\Controllers\InventoryController::class, 'store']);
//     Route::post('/update', [App\Http\Controllers\InventoryController::class, 'update']);
//     Route::post('/delete', [App\Http\Controllers\InventoryController::class, 'delete']);
//     Route::get('/{inventory}/archive', [App\Http\Controllers\InventoryController::class, 'inventory'])->name('inventory');
//     Route::post('/get_inventory_data', [App\Http\Controllers\InventoryController::class, 'fetch_inventory_data']);
// });
// Route::prefix('sales_report')->group(function (){
//     Route::get('/', [App\Http\Controllers\SalesReportController::class, 'index']);
//     Route::post('/date_filter', [App\Http\Controllers\SalesReportController::class, 'date_filter']);
//     Route::get('/today_sale_report', [App\Http\Controllers\SalesReportController::class, 'today_sale_report']);
//     Route::post('/get_sales_report_data', [App\Http\Controllers\SalesReportController::class, 'fetch_sales_report_data']);
// });
// Route::prefix('cleared_sales_report')->group(function (){
//     Route::get('/', [App\Http\Controllers\ClearedSalesReportController::class, 'index']);
//     Route::post('/date_filter', [App\Http\Controllers\ClearedSalesReportController::class, 'date_filter']);
//     Route::post('/get_cleared_sales_report_data', [App\Http\Controllers\ClearedSalesReportController::class, 'fetch_cleared_sales_report_data']);
// });
// Route::prefix('pending_sales_report')->group(function (){
//     Route::get('/', [App\Http\Controllers\PendingSalesReportController::class, 'index']);
//     Route::post('/date_filter', [App\Http\Controllers\PendingSalesReportController::class, 'date_filter']);
//     Route::post('/get_pending_sales_report_data', [App\Http\Controllers\PendingSalesReportController::class, 'fetch_pending_sales_report_data']);
// });
// Route::prefix('users')->group(function (){
//     Route::get('/', [App\Http\Controllers\UserController::class, 'index']);
//     Route::post('/store', [App\Http\Controllers\UserController::class, 'store']);
//     Route::post('/update', [App\Http\Controllers\UserController::class, 'update']);
//     Route::post('/delete', [App\Http\Controllers\UserController::class, 'delete']);
//     Route::post('/get_user_data', [App\Http\Controllers\UserController::class, 'fetch_user_data']);
// });
// Route::prefix('providers')->group(function (){
//     Route::get('/', [App\Http\Controllers\ProviderController::class, 'index']);
//     Route::post('/store', [App\Http\Controllers\ProviderController::class, 'store']);
//     Route::post('/update', [App\Http\Controllers\ProviderController::class, 'update']);
//     Route::post('/delete', [App\Http\Controllers\ProviderController::class, 'delete']);
//     Route::post('/get_provider_data', [App\Http\Controllers\ProviderController::class, 'fetch_provider_data']);
// });
// Route::prefix('accounts_receivable')->group(function (){
//     Route::get('/', [App\Http\Controllers\ReceivableAccountsController::class, 'index']);
//     Route::post('/store_modified_sale', [App\Http\Controllers\ReceivableAccountsController::class, 'store_modified_sale']);
//     Route::post('/date_filter', [App\Http\Controllers\ReceivableAccountsController::class, 'date_filter']);
//     Route::get('/get_article_data', [App\Http\Controllers\ReceivableAccountsController::class, 'fetch_article_data']);
//     Route::get('/{client}/client_sales', [App\Http\Controllers\ReceivableAccountsController::class, 'client_sales'])->name('client_sales');
//     Route::post('/payment_date', [App\Http\Controllers\ReceivableAccountsController::class, 'payment_date']);
//     Route::post('/add_payment', [App\Http\Controllers\ReceivableAccountsController::class, 'add_payment']);
//     Route::post('/get_receivable_accounts_data', [App\Http\Controllers\ReceivableAccountsController::class, 'fetch_receivable_accounts_data']);
// });
// Route::prefix('pos')->group(function (){
//     Route::get('/', [App\Http\Controllers\PosController::class, 'index']);
//     Route::get('/get_article_data', [App\Http\Controllers\PosController::class, 'fetch_article_data']);
//     Route::post('/store', [App\Http\Controllers\PosController::class, 'store']);
//     Route::post('/store_inventory', [App\Http\Controllers\PosController::class, 'store_inventory']);
//     Route::post('/store_client', [App\Http\Controllers\PosController::class, 'store_client']);
//     Route::post('/get_receivable_accounts_data', [App\Http\Controllers\PosController::class, 'fetch_receivable_accounts_data']);
// });
// Route::prefix('sales_history')->group(function (){
//     Route::get('/', [App\Http\Controllers\SalesHistoryController::class, 'index']);
//     Route::post('/store_payment', [App\Http\Controllers\SalesHistoryController::class, 'store_payment']);
//     Route::post('/store_modified_sale', [App\Http\Controllers\SalesHistoryController::class, 'store_modified_sale']);
//     Route::get('/get_article_data', [App\Http\Controllers\SalesHistoryController::class, 'fetch_article_data']);
//     Route::get('/{sale}/edit_sale', [App\Http\Controllers\SalesHistoryController::class, 'edit_sale'])->name('edit_sale');
//     Route::post('/edit_delivery', [App\Http\Controllers\SalesHistoryController::class, 'edit_delivery']);
//     Route::post('/edit_status', [App\Http\Controllers\SalesHistoryController::class, 'edit_status']);
//     Route::post('/delete', [App\Http\Controllers\SalesHistoryController::class, 'delete']);
//     Route::post('/payment_date', [App\Http\Controllers\SalesHistoryController::class, 'payment_date']);
//     Route::post('/add_payment', [App\Http\Controllers\SalesHistoryController::class, 'add_payment']);
//     Route::get('/{sale}/archive', [App\Http\Controllers\SalesHistoryController::class, 'archive'])->name('archive');
//     Route::post('/get_sales_history_data', [App\Http\Controllers\SalesHistoryController::class, 'fetch_sales_history_data']);
// });
// Route::prefix('orders')->group(function (){
//     Route::get('/', [App\Http\Controllers\OrderController::class, 'index']);
//     Route::get('/{sale}/archiv', [App\Http\Controllers\OrderController::class, 'archiv'])->name('archiv');
//     Route::get('/today_order_report', [App\Http\Controllers\OrderController::class, 'today_order_report']);
//     Route::post('/edit_delivery', [App\Http\Controllers\OrderController::class, 'edit_delivery']);
//     Route::post('/edit_status', [App\Http\Controllers\OrderController::class, 'edit_status']);
//     Route::post('/date_filter', [App\Http\Controllers\OrderController::class, 'date_filter']);
//     Route::post('/get_orders_data', [App\Http\Controllers\OrderController::class, 'fetch_orders_data']);
// });
// Route::prefix('service')->group(function (){
//     Route::get('/', [App\Http\Controllers\ServiceController::class, 'index']);
//     Route::post('/delete', [App\Http\Controllers\ServiceController::class, 'delete']);
//     // Route::get('/{client}/client_sales', [App\Http\Controllers\InventoryController::class, 'client_sales'])->name('client_sales');
//     Route::post('/get_service_data', [App\Http\Controllers\ServiceController::class, 'fetch_service_data']);
// });
// Route::prefix('add_service')->group(function (){
//     Route::get('/', [App\Http\Controllers\AddServiceController::class, 'index']);
//     Route::get('/get_article_data', [App\Http\Controllers\AddServiceController::class, 'fetch_article_data']);
//     Route::post('/store', [App\Http\Controllers\AddServiceController::class, 'store']);
//     Route::post('/store_inventory', [App\Http\Controllers\AddServiceController::class, 'store_inventory']);
//     Route::post('/store_client', [App\Http\Controllers\AddServiceController::class, 'store_client']);
//     Route::post('/get_receivable_accounts_data', [App\Http\Controllers\AddServiceController::class, 'fetch_receivable_accounts_data']);
// });
// Route::prefix('accounts_payable')->group(function (){
//     Route::get('/', [App\Http\Controllers\PayableAccountsController::class, 'index']);
//     Route::post('/date_filter', [App\Http\Controllers\PayableAccountsController::class, 'date_filter']);
//     Route::post('/store', [App\Http\Controllers\PayableAccountsController::class, 'store']);
//     Route::post('/store_payment', [App\Http\Controllers\PayableAccountsController::class, 'store_payment']);
//     Route::post('/delete', [App\Http\Controllers\PayableAccountsController::class, 'delete']);
//     Route::post('/delete_payment', [App\Http\Controllers\PayableAccountsController::class, 'delete_payment']);
//     Route::get('/{account}/payment', [App\Http\Controllers\PayableAccountsController::class, 'provider_data'])->name('payment');
//     Route::post('/get_accounts_payable_data', [App\Http\Controllers\PayableAccountsController::class, 'fetch_accounts_payable_data']);
// });
// Route::prefix('add_inventory')->group(function (){
//     Route::get('/', [App\Http\Controllers\AddInventoryController::class, 'index']);
//     Route::post('/delete', [App\Http\Controllers\AddInventoryController::class, 'delete']);
//     Route::post('/store', [App\Http\Controllers\AddInventoryController::class, 'store']);
//     Route::post('/get_service_data', [App\Http\Controllers\AddInventoryController::class, 'fetch_service_data']);
// });
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
