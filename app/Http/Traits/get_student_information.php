<?php
namespace App\Http\Traits;

use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;

trait get_student_information{
    public function get_information(){
        $student=Student::find( Auth::guard("student")->id());
        $my_section_id=$student->my_section->id;
        $data=["student"=>$student,"my_section_id"=>$my_section_id];
        return $data;
    }
    public function printe(){

        return "hjjkjkjk444444444444";
    }
}
