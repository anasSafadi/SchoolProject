<?php

namespace App\Http\Controllers\Homework;

use App\Events\Teacher\lecuterEvent;
use App\Http\Controllers\Controller;
use App\Http\Traits\student_get_notification;
use App\Jobs\insert_notification_for_section;
use App\Jobs\insert_students_for_home_work;
use App\Models\assignment_delivery;
use App\Models\File;
use App\Models\Teacher\Home_work;
use App\Models\Teacher\Section;
use App\Models\Teacher\Sub_material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeworkController extends Controller
{
    use student_get_notification;

    public function view_for_make_homework($id_material){
        $sections=Sub_material::find($id_material)->class_room_of_material->all_sections;
        return view("multiauth.teacher.pages.make_home_work",compact('sections','id_material'));
    }
    public function store_homework(Request $request){
        $v=Validator::make($request->all(),["all_sections_ids"=>"required","end_date"=>"required"]);
        if ($v->fails()){
            return response()->json(["state"=>false,"msg"=>"lack in data"]);
        }
        else{
        $home_work=new Home_work();
        $home_work->title=$request->title;
        $home_work->descriptions=$request->description;
        $home_work->end_date="2023/02/23";
        $home_work->sub_material_id=$request->sub_material_id;
        $home_work->save();
        $home_work->sections()->attach($request->all_sections_ids);
            if (isset($request->files_path)){
                foreach ($request->files_path as $file){
                    $names=explode("*",$file);
                    File::create([
                        "url"=>$names[0],
                        "client_name"=>$names[1],
                        "fileable_id"=>$home_work->id,
                        "fileable_type"=>"App\Models\Teacher\Home_work"
                    ]);}}

            $name_material=Sub_material::find($request->sub_material_id)->material->name;
            $data="تم اضافة نشاط مادة :"." ".$name_material;

            insert_notification_for_section::dispatch($request->all_sections_ids,$data);
            insert_students_for_home_work::dispatch($request->all_sections_ids,$home_work->id);

            foreach ($request->all_sections_ids as $id_section){
                event(new lecuterEvent($data,$id_section));
            }
            return response()->json(["state"=>true,"msg"=>"success"]);

        }

    }

    public function insert_delivery_home_work($id_of_home_work){
        $sub_materials=$this->get_notification_s()["materials"];
        $home_work=Home_work::find($id_of_home_work);

        $dilever=$home_work->assignment_delivery->where("student_id",$this->get_notification_s()["student"]->id)->first();

        if(is_null($dilever)){
            toastr()->error("السيرفر مشغول ");
            return redirect()->back();
        }
        $notification=$this->get_notification_s()["notification"];
        $my_section_id=$this->get_notification_s()["section_id"];


        return view("multiauth.student.pages.add_my_home_work",compact("sub_materials",'home_work','notification',"my_section_id","dilever"));

    }
    public function store_delivery(Request $request){


        $a=assignment_delivery::find($request->dilever_id);
        $a->active="1";
        $a->save();

        if (isset($request->files_path)){
            foreach ($request->files_path as $file){
                $names=explode("*",$file);
                File::create([
                    "url"=>$names[0],
                    "client_name"=>$names[1],
                    "fileable_id"=>$a->id,
                    "fileable_type"=>"App\Models\assignment_delivery"
                ]);}}
        toastr()->success("THANE YOU");
        return response()->json(['state'=>true,]);

    }

    public function get_all_homework(){
        $materials=Sub_material::where("teacher_id",Auth::guard("teacher")->id())->get();
        return view('multiauth.teacher.pages.get_all_homework',compact('materials'));
    }

    public function show_student_of_home_work($id_home_work){
        $home_work=Home_work::find($id_home_work);
        return view('multiauth.teacher.pages.show_student_of_home_work',compact('home_work'));

    }
}
