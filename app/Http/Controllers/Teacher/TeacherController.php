<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher\Classroom;
use App\Models\Teacher\Grade;
use App\Models\Teacher\Sub_material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Ramsey\Collection\Map\get;

class TeacherController extends Controller
{
   public function index(){

       $ids_of_grades=[];
       $count_teacher_in_class=[];
       $g=Grade::all();
       foreach ($g as $x=>$grade){
           $ids_of_grades[$x]=$grade->id;
           foreach ($grade->all_class_rooms as $x2=>$classroom){
               foreach ($classroom->sub_material as $x3=>$sub )
               $count_teacher_in_class[$classroom->id][$x3]=$sub->teacher->id;
           }

       }
      
       $count_teacher_in_grades=Sub_material::select("teacher_id")->where("grade_id",$ids_of_grades)->distinct()->get()->count();

       return view("dashboard",compact('g',"count_teacher_in_grades","count_teacher_in_class"));
   }
}
