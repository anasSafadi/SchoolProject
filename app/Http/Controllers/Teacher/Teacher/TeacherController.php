<?php

namespace App\Http\Controllers\Teacher\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
   public function view(){
       $spe=Specialty::all();
       return view("pages.teachers.add_teacher",compact("spe"));
   }
    public function add_teacher(Request $request){
        try {
            $s=Teacher::create([
                'name'=>['en'=>$request->name_en,'ar'=>$request->name_ar],
                'email'=>$request->email,
                "password"=>Hash::make($request->password),
                "Joining_Date"=>$request->date,
                "phone"=>$request->phone,
                "specialty_id"=>$request->spe
            ]);
            toastr()->success("Success");
            return redirect()->back();
        }catch (\Exception $e){
            toastr()->error("Success");
            return redirect()->back();
        }

    }
    public function show_all_teachers(){
       $teachers=Teacher::all();

        return view("pages.teachers.show-all-teachers",compact('teachers'));
    }
}
