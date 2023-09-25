<?php

namespace App\Http\Controllers\multiauth\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Traits\teacher_get_notification;
use App\Models\Teacher;
use Dflydev\DotAccessData\Data;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use function League\Flysystem\toArray;


class TeacherController extends Controller
{
    use teacher_get_notification;
   public function index(){


       $ids_of_grades=[];
       $id=Auth::guard("teacher")->id();
       $teacher=Teacher::find($id);
       $my_grades =DB::table('sub_material')->select("grade_id")->where("teacher_id",$id)->distinct()->get();

       foreach ($my_grades as $grade){
           array_push($ids_of_grades, $grade->grade_id);
       }
       $grades=Teacher\Grade::find($ids_of_grades);

       return view("multiauth.teacher.dashboard",compact('grades'));
   }

   public function show_my_class($id_grade){
       $ids_of_class=[];
       $id=Auth::guard("teacher")->id();
       $teacher=Teacher::find($id);
       $all_my_class =DB::table('sub_material')->select("classroom_id")->where("grade_id",$id_grade)->where("teacher_id",$id)->distinct()->get();

       foreach ($all_my_class as $my_class){
           array_push($ids_of_class, $my_class->classroom_id);
       }
       $class_rooms=Teacher\Classroom::find($ids_of_class);
       return view("multiauth.teacher.pages.list_class",compact('class_rooms'));

   }
    public function class_show_my_material($id_class){

              $class=Teacher\Classroom::find($id_class);
              $materials = Teacher\Sub_material::where('classroom_id', "=",$id_class)->where("teacher_id","=",Auth::guard("teacher")->id())->get();
        return view("multiauth.teacher.pages.list_materials",compact('materials','class'));

    }
}
