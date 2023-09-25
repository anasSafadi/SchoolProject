<?php


use App\Http\Controllers\MSG\Admin\MsgController;
use App\Http\Controllers\Teacher\Classrooms\ClassroomsController;
use App\Http\Controllers\Teacher\Material\MaterialController;
use App\Http\Controllers\Teacher\Teacher\TeacherController;
use \App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Teacher\zoom\ZoomController;
use App\Mail\Admin\AdminMail;
use Illuminate\Support\Facades\Route;




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
//URL::forceScheme('https');
Route::get("get_class",[App\Http\Controllers\Teacher\Grades\GradesController::class,"get_class"])->name("get_class");

Route::redirect("/","/login");
Route::get("/login",[AuthController::class,"view"])->name("login")->middleware("guest");
Route::post("/login",[AuthController::class,"do_login"])->name("do_login");
Route::get("/logout",[AuthController::class,"logout"])->name("logout");

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath',"auth"]
    ], function(){

    Route::get('/index', [\App\Http\Controllers\teacher\TeacherController::class,"index"])->name('index');
    Route::get('/index/grades', [App\Http\Controllers\Teacher\Grades\GradesController::class,"view"])->name('view.grades');
    Route::get('/index/class-rooms', [App\Http\Controllers\Teacher\Classrooms\ClassroomsController::class,"view"])->name('view.classrooms');
    Route::get('/index/delete_class_room/{id}', [App\Http\Controllers\Teacher\Classrooms\ClassroomsController::class,"delete_class_room"])->name('delete_class_room');

    /**sections**/
//    Route::get("get_class",function(){
//
//        $areas=[
//            ["en"=>"Bureij","ar"=>"البريج"],
//            ["en"=>"Nuseirat","ar"=>"النصيرات"],
//            ["en"=>"Maghazi","ar"=>"المغازي"],
//
//        ];
//
//        foreach ($areas as $area) {
//            $class=new Area();
//            $class->name_area=$area;
//            $class->created_at='2023-05-18 02:20:27';
//            $class->updated_at='2023-05-18 02:20:27';
//            $class->save();
//        }
//
//    })->name("sssget_class");


    Route::get("/index/sections",[\App\Http\Controllers\Teacher\Sections\SectionsController::class,"view"])->name("sections");
    Route::get("/index/sections/delete/{id}",[\App\Http\Controllers\Teacher\Sections\SectionsController::class,"delete_section"])->name("delete_section");

    Route::view('/index/add-parent', "pages\student_parents\students_parents")->name("students_parents");



    /**-------------------------------------------- teacher--------------------------**/
    Route::get("index/add-teacher",[TeacherController::class,"view"])->name('teacher');
    Route::post("index/store-teacher",[TeacherController::class,"add_teacher"])->name('add-teacher');
    Route::get("index/show-all-teachers",[TeacherController::class,"show_all_teachers"])->name('show-all-teachers');




    /**-------------------------------------------end teacher--------------------------------**/


    /**-------------------------------------------start Material--------------------------------**/
    Route::get("index/get_materials",[MaterialController::class,"view_list_material"])->name('get_materials');;
    Route::get("index/store_material",[MaterialController::class,"view"])->name('add_material');;
    Route::post("index/store_material",[MaterialController::class,"store_material"])->name('store_material');
    /**-------------------------------------------end Material--------------------------------**/




        /**---------------------------student-------------------------------**/
    Route::get('/index/add-student', [\App\Http\Controllers\Students\StudentController::class,"add_student"])->name('add_students');
    Route::get('/index/get-class', [\App\Http\Controllers\Students\StudentController::class,"get_class"])->name('get_class_for_student');
    Route::get('/index/get-sections', [\App\Http\Controllers\Students\StudentController::class,"get_sections"])->name('get_sections_for_student');
    Route::get('/index/get-all-students', [\App\Http\Controllers\Students\StudentController::class,"get_all_students"])->name('get.all.students');
    Route::get('/index/push-students', [\App\Http\Controllers\Students\StudentController::class,"push_students"])->name('push_students');
    Route::post("/student/register",[\App\Http\Controllers\Students\StudentController::class,"student_register_store"])->name("student.register.store");
    Route::get('/index/get-student', [\App\Http\Controllers\Students\StudentController::class,"get_student"])->name('getall_students');

    /**-------------------------------------------end student----------------------------------------------**/


    /**-------------------------------------------- send msg--------------------------**/
    Route::post("index/send_msg_from_admin_to_teachers",[MsgController::class,"send_msg_to_teachers"])->name('send_msg_from_admin_to_teachers');

    Route::get("index/get_all_messages",[MsgController::class,"get_all_messages"])->name('get_all_messages');
    Route::get("index/delete_all_msg_from_admin",[MsgController::class,"delete_all_msg_from_admin"])->name('delete_all_msg_from_admin');


    /**-------------------------------------------- end send msg--------------------------**/



    });


Route::post('/add_grade', [App\Http\Controllers\Teacher\Grades\GradesController::class,"add_grade"])->name('add_grade');
Route::get('/edit_grade/{id}', [App\Http\Controllers\Teacher\Grades\GradesController::class,"edit_grade"])->name('edit_grade');
Route::get('/delete_grade/{id}', [App\Http\Controllers\Teacher\Grades\GradesController::class,"delete_grade"])->name('delete_grade');

/** add class */

Route::post('/add_class', [App\Http\Controllers\Teacher\Classrooms\ClassroomsController::class,"add_class"])->name('add_class');
Route::post('/delete_class/delete_delete_class', [App\Http\Controllers\Teacher\Classrooms\ClassroomsController::class,"delete_class"])->name('class.rooms.destroy');




/**sections**/
Route::post('/add_section/', [App\Http\Controllers\Teacher\Sections\SectionsController::class,"add_section"])->name('add_section');



//Route::get("/test",function (){
//    \Illuminate\Support\Facades\Mail::to('engines.m.99@gmail.com')->send(new AdminMail());
//    \App\Jobs\send_mail_to_teacher::dispatch();
//});

Route::post("/student/upload_files",[\App\Http\Controllers\Students\StudentController::class,"upload_file_file_pond"]);


Route::get("test_start",[\App\Http\Controllers\TestController::class,'index']);
Route::post("test_start",[\App\Http\Controllers\TestController::class,'set_name'])->name("insert_name");
Route::view("pdf","pdf.exam");
