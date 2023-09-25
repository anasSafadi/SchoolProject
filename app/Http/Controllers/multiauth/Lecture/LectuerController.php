<?php

namespace App\Http\Controllers\multiauth\Lecture;

use App\Events\Teacher\lecuterEvent;
use App\Events\test;
use App\Http\Controllers\Controller;
use App\Http\Traits\teacher_get_notification;
use App\Jobs\insert_notification_for_section;
use App\Models\File;
use App\Models\Notification;
use App\Models\Teacher;
use App\Models\Teacher\Lecture;
use App\Models\Teacher\Sub_material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LectuerController extends Controller
{

    public function index($id_sub_material){

        $sub_materia=Sub_material::find($id_sub_material);
        return view("multiauth.teacher.pages.create_lecture",compact("sub_materia"));
    }

    public function store_lecture(Request $request){
        try {
        $validator=Validator::make($request->all(),['title'=>'required','description'=>'required']);
        if ($validator->fails()){
            return response()->json(['state'=>false,'error'=>$validator->errors()]);
        }
        $le=new Lecture();
        $le->title=$request->title;
        $le->description=$request->description;
        $le->sub_material_id=$request->sub_material_id;
        $le->teacher_id=Auth::guard()->id();
        $le->save();
        $le->all_sections()->attach($request->all_sections_ids);
        if (isset($request->files_path)){
            foreach ($request->files_path as $file){
                $names=explode("*",$file);
                File::create([
                    "url"=>$names[0],
                    "client_name"=>$names[1],
                    "fileable_id"=>$le->id,
                    "fileable_type"=>"App\Models\Teacher\Lecture"
                ]);
            }}
            if (!is_null($request->description_url)&&
                !is_null($request->all_url)&&
                count($request->description_url)>0
                &&count($request->description_url)==count($request->all_url)){
                foreach ($request->description_url as $x=>$title_url){
                    Teacher\URLS::create(['description'=>$title_url?:'title_notfount',
                        'url'=>$request->all_url[$x]?:"https://google.com",
                        "lecture_id"=>$le->id]);
                }
            }
            $name_material=Sub_material::find($request->sub_material_id)->material->name;
        $data="تم اضافة محاضرة جديدة مادة :"." ".$name_material."(".$request->title.")";

        insert_notification_for_section::dispatch($request->all_sections_ids,$data);

        foreach ($request->all_sections_ids as $id_section){
            event(new lecuterEvent($data,$id_section));
        }


//        if (!is_null($request->files_path)&&count($request->files_path)>0){
//            foreach ($request->files_path as $file){
//                File::create(['name_of_file'=>'testname','path'=>$file,'lecture_id'=>$Le->id]);}}
//        if (!is_null($request->description_url)&&
//            !is_null($request->all_url)&&
//            count($request->description_url)>0
//            &&count($request->description_url)==count($request->all_url)){
//            foreach ($request->description_url as $x=>$title_url){
//                myurl::create(['title_url'=>$title_url?:'title_notfount','url'=>$request->all_url[$x]?:"https://google.com"]);
//            }
//        }
        return response()->json(["state"=>true]);  }
        catch (\Exception $e){
            return response()->json(["state"=>false]);
        }

    }

     public function view_presence_absence()
    {

        return view("multiauth.teacher.pages.presence_absence");
    }

    public function get_lectures_for_teacher(){


        $sub=Sub_material::where("teacher_id",Auth::guard("teacher")->id())->get();


        return view("multiauth.teacher.pages.lis_lectures",compact("sub"));

    }
    public function edit_view_lecturer($id_lecturer){

        $lec=Lecture::find($id_lecturer);
        foreach($lec->all_sections as $x=>$section_lec){
        $ids[$x]=$section_lec->id;}




        return view("multiauth.teacher.pages.edit_lecture",compact('lec',"ids"));
    }
    public function store_edit_lecturer(Request $request){




        $lec=Lecture::find($request->id_le);
        $lec->title=$request->title;
        $lec->description=$request->description;
        $lec->urls()->delete();
        $lec->files()->delete();
        $lec->save();
        if (isset($request->old_files_url)){
            foreach ($request->old_files_url as $x=>$file){
                File::create([
                    "url"=>$file,
                    "client_name"=>$request->old_files_client_name[$x],
                    "fileable_id"=>$lec->id,
                    "fileable_type"=>"App\Models\Teacher\Lecture"
                ]);
            }}
        if (!is_null($request->description_url)&&
            !is_null($request->all_url)&&
            count($request->description_url)>0
            &&count($request->description_url)==count($request->all_url)){
            foreach ($request->description_url as $x=>$title_url){
                Teacher\URLS::create(['description'=>$title_url?:'title_notfount',
                    'url'=>$request->all_url[$x]?:"https://google.com",
                    "lecture_id"=>$lec->id]);
            }
        }

       $lec->all_sections()->sync($request->all_sections_ids);
        return response()->json(["state"=>true]);

    }

    public function delete_lecturer($id_lecturer){
        Lecture::find($id_lecturer)->delete();
        toastr()->success("تم الحذف");
        return redirect()->back();
    }

}
