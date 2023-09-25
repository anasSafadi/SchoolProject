<?php

use App\Http\Controllers\Exams\ExamController;
use App\Http\Controllers\Homework\HomeworkController;
use App\Http\Controllers\multiauth\Teacher\zoom\ZoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\multiauth\Student\StudentController as mu_student;

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
Route::get("/student/download,{url}",[mu_student::class,"download_file"])->name("download_file");


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath',"auth:student"]
    ], function(){
    Route::get("/student/index",[mu_student::class,"index"])->name("index_of_student");
    Route::get("/student/index/lecture/{id_sub}",[mu_student::class,"show_lectures"])->name("show_lecture");

    Route::get("/student/index/get_zoom_lectures",[ZoomController::class,"get_all_for_student"])->name("show_zoom_lecture");
    Route::get("/student/insert_delivery_home_work/{id_home_work}",[HomeworkController::class,"insert_delivery_home_work"])->name("insert_delivery_home_work");
    Route::post("/student/update_delivery_home_work",[HomeworkController::class,"store_delivery"])->name("store_delivery");
    Route::get("/student/apply/exam/{exam_id}",[ExamController::class,"apply_exam"])->name('show_my_exams');
});






