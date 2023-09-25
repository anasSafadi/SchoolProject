<?php

namespace App\Http\Controllers\Teacher\Grades;

use App\Http\Controllers\Controller;
use App\Models\Teacher\Grade;
use Illuminate\Http\Request;

class GradesController extends Controller
{
    public function view(){
        $Grade = Grade::all();
        return view("pages.Grades.Grades",compact('Grade'));
    }
    public function add_grade(Request $request){

        $g=new Grade();
        $g->name=["en"=>$request->name_en,"ar"=>$request->name_ar];
        $g->note=$request->note;
        $g->save();
        toastr()->success("Add Success");
        return redirect()->back();
    }
    public function edit_grade(Request $request,$id){

        $g=Grade::find($id);
        $g->name=["en"=>$request->name_en,"ar"=>$request->name_ar];
        $g->note=$request->note;
        $g->save();
        toastr()->info("update Success");
        return redirect()->back();
    }
    public function delete_grade($id){

        $g=Grade::find($id);
        if ($g->all_class_rooms->count()>0){
            toastr()->error("We Cant Delete");
            return redirect()->back();
        }
        $g->delete();
        toastr()->warning("delete Success");
        return redirect()->back();
    }
    public function get_class(Request $request){

        $all_class=[];
        $class=Grade::find($request->id)->all_class_rooms;

        foreach ($class as $x=>$item){
            $all_class[$x]=[$item["id"],$item["name_class"]];
        }

       return  response()->json(["state"=>true,"items"=>$all_class]);
    }
}
