<?php

namespace App\Http\Controllers\Teacher\Material;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use function Symfony\Component\Mime\Header\all;

class MaterialController extends Controller
{
    public function view(){
        $teachers=Teacher::all();
        $grades=Teacher\Grade::all();

        return view("pages.materials.materials",compact('teachers','grades'));
    }
    public function store_material(Request $request){

       $all_class_ids= explode(",",$request->my_all_class_rooms);
        $all_teacher_ids= explode(",",$request->my_teachers_ids);


        if (count($all_class_ids)!=count($all_teacher_ids)){
            toastr()->warning("خطا في المعلومات المدخلة");
            return redirect()->back();
        }

        $grade_and_class=Teacher\Classroom::find($all_class_ids);



        $material=Teacher\Material::create([
            "name"=>["en"=>$request->name_en,"ar"=>$request->name_ar],
        ]);

        foreach ($all_class_ids as $x=>$sub){

            Teacher\Sub_material::create([
                "material_id"=>$material->id,
                "classroom_id"=>$sub,
                "grade_id"=>Teacher\Classroom::find($sub)->grade->id,
                "teacher_id"=>$all_teacher_ids[$x]
            ]);
        }



//        $material->all_class()->attach($all_class_ids);
//      $material->teachers()->attach($all_teacher_ids);


        toastr()->success("Add Success");
        return redirect()->back();
    }


    public function view_list_material(){
        $grades=Teacher\Grade::all();
        return view("pages.materials.list_materials",compact('grades'));
    }

}
