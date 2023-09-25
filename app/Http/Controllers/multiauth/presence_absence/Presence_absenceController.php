<?php

namespace App\Http\Controllers\multiauth\presence_absence;

use App\Http\Controllers\Controller;
use App\Http\Traits\teacher_get_notification;
use App\Models\Teacher;
use App\Models\Teacher\Grade;
use App\Models\Teacher\Sub_material;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Presence_absenceController extends Controller
{
    use teacher_get_notification;
   public function view_presence_absence(){
       $ids_of_grades=[];
       $id=Auth::guard("teacher")->id();
       $teacher=Teacher::find($id);
       $my_grades =DB::table('sub_material')->select("grade_id")->where("teacher_id",$id)->distinct()->get();

       foreach ($my_grades as $grade){
           array_push($ids_of_grades, $grade->grade_id);
       }
       $grades=Teacher\Grade::find($ids_of_grades);
       $notification=$this->get_notification();

       return view("multiauth.teacher.pages.Presence_absence",compact('grades','notification'));}


// 404
   public function get_teacher_class(Request $request){

       $ids_of_class=[];
       $id=Auth::guard("teacher")->id();
       $teacher=Teacher::find($id);
//       404
       $all_my_class =DB::table('sub_material')->select("classroom_id")->where("grade_id",$request->id)->where("teacher_id",$id)->distinct()->get();

       foreach ($all_my_class as $my_class){
           array_push($ids_of_class, $my_class->classroom_id);
       }
       $class_rooms=Teacher\Classroom::find($ids_of_class);
       $data=[];
       foreach ($class_rooms as $x=>$class){
          $data[$x]=[$class->id,$class->name_class];
      }
       return response()->json(["state"=>true,"items"=>$data]);
              }


    public function get_sub_by_class_id(Request $request){

        $data_sub_materials=[];
        $data_sections=[];
        $c=Teacher\Classroom::find($request->id_of_class);

//        $sub_material=$c->sub_material->where("teacher_id",Auth::guard("teacher")->id());
        $sub_material=Sub_material::where("classroom_id",$c->id)->where("teacher_id",Auth::guard("teacher")->id())->get();




        foreach ($sub_material as $x=>$item){
            $data_sub_materials[$x]=[$item->id,$item->material->name];
        }

        $sections=$c->all_sections;

        foreach ($sections as $x=>$item){
            $data_sections[$x]=[$item->id,$item->name_section];
        }
        return response()->json(["state"=>true,"sub_materials"=>$data_sub_materials,"sections"=>$data_sections]);
    }
    public function get_student_by_section(Request $request){
        $data=Teacher\Section::find($request->section_id)->students;
        $students=[];
        foreach ($data as $x=>$item){
            $students[$x]=[$item->id,$item->name];
        }

        return response()->json(["state"=>true,"students"=>$students]);
    }
    public function store_presence_absence(Request $request){

       try{
           $one=Teacher\presence_absence::create([
               "title"=>Carbon::now()->format('m/d'),
               "sub_material_id"=>$request->id_sub,
               "section_id"=>$request->id_section
           ]);
       if(isset($request->presence)){

           $one->students()->attach($request->presence, ['active' => "1"]);

       } ;
        if(isset($request->absence)){


            $one->students()->attach($request->absence, ['active' => "0"]);

        } ;
       return response()->json(["state"=>true]);

    }catch (\Exception $e){
           return response()->json(["state"=>false]);
       }
    }



    public function get_presence_absence(){
        $ids_of_grades=[];
        $id=Auth::guard("teacher")->id();
        $teacher=Teacher::find($id);
        $my_grades =DB::table('sub_material')->select("grade_id")->where("teacher_id",$id)->distinct()->get();

        foreach ($my_grades as $grade){
            array_push($ids_of_grades, $grade->grade_id);
        }
        $grades=Teacher\Grade::find($ids_of_grades);

        $materials = Sub_material::where("teacher_id","=",Auth::guard("teacher")->id())->get();

        return view("multiauth.teacher.pages.get_presence_absence",compact("materials",'grades'));


}
}
