<?php

namespace App\Http\Controllers\Teacher\Sections;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\Teacher\Grade;
use App\Models\Teacher\Section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function view(){
        $grades=Grade::all();
        $teachers=Teacher::all();
        return view("pages.sections.sections",compact("grades","teachers"));
    }
    public function add_section(Request $request){
        $section=new Section();
        $section->name_section=["en"=>$request->name_section_en,"ar"=>$request->name_section_ar];;
        $section->states=$request->state_of_section ?"1":"0";
        $section->classroom_id=$request->class_of_section;
        $section->save();
        //$section->teachers()->attach($request->teachers_of_section);

        return redirect()->back();
    }
    public function delete_section($id){
        $section=Section::findorfail($id);
        if(isset($section->students) && $section->students->count()>0){


            toastr()->error("لايمكن حذف القسم بسبب وجود طلاب فيه");
            return redirect()->back();

        }else{
            $section->delete();
            toastr()->warning("Success");
            return redirect()->back();
        }
    }
}
