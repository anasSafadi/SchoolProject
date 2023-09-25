<?php

namespace App\Http\Controllers\multiauth\Student;

use App\Http\Controllers\Controller;
use App\Http\Traits\student_get_notification;
use App\Models\Notification;
use App\Models\Student\Student;
use App\Models\Teacher\Classroom;
use App\Models\Teacher\Lecture;
use App\Models\Teacher\Section;
use App\Models\Teacher\Sub_material;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\b;
use function Symfony\Component\String\s;

class StudentController extends Controller
{
    use student_get_notification;


    public function index(){


        $my_section_id=$this->get_notification_s()["section_id"];
        $notification=$this->get_notification_s()["notification"];
        $student=$this->get_notification_s()["student"];

        $sub_materials=$this->get_notification_s()["materials"];

        return view("multiauth.student.dashboard",compact("sub_materials","my_section_id","notification"));
    }
    public function show_lectures($id_of_sub){

        $material=Sub_material::find($id_of_sub);
        $my_section_id=$this->get_notification_s()["section_id"];
        $notification=$this->get_notification_s()["notification"];
        $the_section=Section::find($my_section_id);
        $my_lectures=$the_section->lectures->where("sub_material_id","$id_of_sub");
        $home_works=$the_section->homeworks->where("sub_material_id","$id_of_sub");
        $exams=$the_section->exams->where("sub_material_id","$id_of_sub")->where("state","1");
        $sub_materials=$this->get_notification_s()["materials"];


        return view("multiauth.student.pages.list_lecture",compact("my_lectures","my_section_id","notification","home_works",'exams','sub_materials','material'));
    }
    public function download_file($url){
        if(!file_exists(storage_path("\\app\\files\\".$url))){
            toastr()->error("تم حذف الملف !!");
            return redirect()->back();
        };
        return response()->download(storage_path("\\app\\files\\".$url));
    }
}
