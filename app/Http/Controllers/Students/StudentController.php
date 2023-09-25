<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Notification;
use App\Models\Student\Student;
use App\Models\Teacher\Classroom;
use App\Models\Teacher\Grade;
use App\Repository\StudentsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Ramsey\Uuid\v1;

class StudentController extends Controller
{
    protected $student;
    public function __construct(StudentsRepositoryInterface $student)
    {
        $this->student = $student;
    }
    public function get_all_students(){

        $students=Student::all();
        return view("pages.students.list_student",compact('students'));
    }
   public function add_student(){
        return $this->student->add_student();
   }
   public function get_class(Request $request){
       $all_class=[];
       $class=Grade::find($request->id)->all_class_rooms;

       foreach ($class as $x=>$item){
           $all_class[$x]=[$item["id"],$item["name_class"]];
       }

       return  response()->json(["state"=>true,"items"=>$all_class]);
   }
    public function get_sections(Request $request){
        $all_sections=[];
        $sections=Classroom::find($request->id)->all_sections;

        foreach ($sections as $x=>$item){
            $all_sections[$x]=[$item["id"],$item["name_section"]];
        }
        return  response()->json(["state"=>true,"items"=>$all_sections]);
    }

    public function upload_file_file_pond(Request $request){

        if($request->hasFile("avatar")){

        $file=$request->file("avatar");
        $file_ex=$file->extension();
        $fileOriginalName=$file->getClientOriginalName();
        $un_file_name=uniqid().".".$file_ex;

        $file->storeAs("/files",$un_file_name);

        return $un_file_name."*".$fileOriginalName;}
    }
    public function student_register_store(Request $request){

        $s=Student::create([
            'name'=>['en'=>$request->name_en,'ar'=>$request->name_ar],
            'email'=>$request->email,
            "password"=>Hash::make($request->password),
            "Date_Birth"=>$request->Date_Birth,
            "grade_id"=>$request->grade_id,
            "classroom_id"=>$request->classroom_id,
            "section_id"=>$request->section_id,
            "parent_id"=>$request->parent_id,
            "academic_year"=>now(),
        ]);



        if(isset($request['files'])){
            foreach ($request['files'] as $file){
                File::create([
                    "url"=>uniqid(),
                    "client_name"=>$file,
                    "fileable_id"=>$s->id,
                    "fileable_type"=>"App\Models\Student\Student"
                ]);
            }}

        return response()->json(["state"=>true]);
          }
    public function push_students(){
        $grades=Grade::all();
              return view("pages.students.push_students",compact('grades'));
          }
          public function get_student(){
        $student=Student::all();


                return view("pages.students.get_student",compact('student'));          }

}
