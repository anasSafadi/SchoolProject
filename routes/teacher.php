
<?php

use App\Http\Controllers\downloadfilesController;
use App\Http\Controllers\Exams\ExamController;
use App\Http\Controllers\Homework\HomeworkController;
use App\Http\Controllers\multiauth\Lecture\LectuerController as Lecture;
use App\Http\Controllers\multiauth\presence_absence\Presence_absenceController;
use App\Http\Controllers\multiauth\Teacher\zoom\ZoomController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Teacher\Material\MaterialController;
use App\Http\Controllers\Teacher\Teacher\TeacherController;
use \App\Http\Controllers\multiauth\Teacher\TeacherController as mu_Teacher;
use Illuminate\Support\Facades\Route;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath',"auth:teacher"]
    ], function(){
        Route::get("/teacher/index",[mu_Teacher::class,"index"]);
        Route::get("/teacher/index/show_my_class/{id?}",[mu_Teacher::class,"show_my_class"])->name("grade_show_my_class");
        Route::get("/teacher/index/show_my_class/show_my_material/{id?}",[mu_Teacher::class,"class_show_my_material"])->name("class_show_my_material");

        /**lecture**/
        Route::get("/teacher/index/create_lectures/{id_sub_material}",[Lecture::class,"index"])->name("create_lecture");
        Route::post("/teacher/index/store_lecture",[Lecture::class,"store_lecture"])->name("store_lecture");

        Route::get("/teacher/index/get_lectures_for_teacher",[Lecture::class,"get_lectures_for_teacher"])->name("get_lectures_for_teacher");
        Route::get("/teacher/index/delete_lecturer/{id_lecturer}",[Lecture::class,"delete_lecturer"])->name("delete_lecturer");
        Route::get("/teacher/index/edit_lecturer/{id_lecturer}",[Lecture::class,"edit_view_lecturer"])->name("edit_view_lecturer");
        Route::post("/teacher/index/store_edit_lecturer",[Lecture::class,"store_edit_lecturer"])->name("store_edit_lecturer");


        Route::get("/teacher/index/zoom/{id_sub_material}",[ZoomController::class,"view"])->name('create_zoom');
        Route::post("/teacher/index/zoom/store/{id_sub_material}",[ZoomController::class,"store_zoom_lecture"])->name("store_zoom");
        Route::get("/teacher/index/get/zoom/lectures",[ZoomController::class,"zoom_lectures"])->name("zoom.lectures");

    /**endlecture**/


//    ---------------------------------------start presence_absence---------------------------------

        Route::get("/teacher/index/presence_absence",[Presence_absenceController::class,"view_presence_absence"]);

        Route::post("/teacher/index/get_my_class_for_active",[Presence_absenceController::class,"get_teacher_class"])->name('get_class_for_teacher');
        Route::post("/teacher/index/get_my_sub_for_active",[Presence_absenceController::class,"get_sub_by_class_id"])->name('get_sub_by_class_id');
        Route::post("/teacher/index/get_my_students_for_active",[Presence_absenceController::class,"get_student_by_section"])->name('get_student_by_section');

        Route::post("teacher/store_presence_absence",[Presence_absenceController::class,"store_presence_absence"])->name('store_presence_absence');

        Route::get("teacher/get_presence_absence",[Presence_absenceController::class,"get_presence_absence"])->name('get_presence_absence');

//    ---------------------------------------start Home work---------------------------------

    Route::get("teacher/make/homework/{id_material}",[HomeworkController::class,"view_for_make_homework"])->name('make_homework');
    Route::post("teacher/store/homework",[HomeworkController::class,"store_homework"])->name('store_homework');

    Route::get("teacher/get/all/homework",[HomeworkController::class,"get_all_homework"])->name('get_all_homework');

    Route::get("teacher/get/all/students/homework/{id_home_work}",[HomeworkController::class,"show_student_of_home_work"])->name('show_student_of_home_work');
//    ---------------------------------------start Exams---------------------------------
    Route::get("teacher/make/exam",[ExamController::class,"new_exam"])->name('new_exam');
    Route::post("teacher/store/exam",[ExamController::class,"store_exam"])->name('store_exam');
    Route::get("teacher/get/all/exam",[ExamController::class,"get_all_exams"])->name('get_all_exams');


    Route::get("teacher/get/show/questions/{id_exam}",[ExamController::class,"show_questions"])->name('show_questions');

    Route::get("teacher/add/question/{id_exam}",[ExamController::class,"add_question"])->name('add_question'); /**return view**/

    Route::post("teacher/store/question",[ExamController::class,"store_question"])->name('store_question');

    Route::post("teacher/save/question/answers",[ExamController::class,"store_answers"])->name('store_answers');
    Route::get("teacher/make/exam/public/{exam_id}",[ExamController::class,"public_exam"])->name('public_exam');
    Route::get("teacher/make/exam/private/{exam_id}",[ExamController::class,"private_exam"])->name('private_exam');
    Route::get("teacher/delete/exam/delete_exam_by_teacher/{exam_id}",[ExamController::class,"delete_exam_by_teacher"])->name('delete_exam_by_teacher');


    Route::get("teacher/get/exam/marks/{id_exam}",[ExamController::class,"get_marks"])->name('get_marks');
//                                        pdf
    Route::get("teacher/save/exam/pdf/{id_exam}",[PdfController::class,"make_exam"])->name('exam_pdf');




});



Route::get("/download/files/for_teacher/{id_file}",[downloadfilesController::class,"download_files_for_teacher"])->name('download_files_for_teacher');


