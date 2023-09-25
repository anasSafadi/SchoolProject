<?php
namespace App\Http\Traits;
use App\Models\Notification;
use App\Models\Student\Student;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

trait student_get_notification{

    public function get_notification_s(){

        $student=Student::find(Auth::guard("student")->id());
        $my_section_id=$student->my_section->id;

        $notification=Notification::whereHas('sections', function (Builder $query) use ($my_section_id) {
            $query->where('notification_section.section_id', "=",$my_section_id);
        })->get();
        $sub_materials=$student->my_class->sub_material;
        $data=["section_id"=>$my_section_id,"notification"=>$notification,"student"=>$student,"materials"=>$sub_materials];
        return $data;
    }
}
