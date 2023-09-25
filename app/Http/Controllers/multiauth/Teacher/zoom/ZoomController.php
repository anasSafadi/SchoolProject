<?php

namespace App\Http\Controllers\multiauth\Teacher\zoom;

use App\Events\Teacher\lecuterEvent;
use App\Http\Controllers\Controller;

use App\Http\Traits\student_get_notification;
use App\Http\Traits\teacher_get_notification;
use App\Models\Notification;
use App\Models\Teacher\Online;
use App\Models\Teacher\Sub_material;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use MacsiDigital\Zoom\Facades\Zoom;

class ZoomController extends Controller
{
    use student_get_notification;
    use teacher_get_notification;

    public function view($id_sub_material){
        $notification=$this->get_notification();
        $sub_material=Sub_material::find($id_sub_material);
        return view("multiauth.teacher.pages.create_zoom",compact("sub_material","notification"));
    }


    public function store_zoom_lecture(Request $request,$id_sub_material){
        try {


        $ids_of_sections=explode(",",$request->sections_of_zoom);
        $v=Validator::make($request->all(),["topic"=>"required","duration"=>"required","password"=>"required"]);
        if ($v->fails()){
            return redirect()->back();
        }

        $user = Zoom::user()->first();
        $meetingData = [
            'topic' => $request->topic,
            'duration' =>$request->duration,
            'password' =>$request->password,
            'start_time' => $request->start_time,
            'timezone' => config('zoom.timezone')
            // 'timezone' => 'Africa/Cairo'
        ];
        $meeting = Zoom::meeting()->make($meetingData);

        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video' => false,
            'participant_video' => false, /**close camera of clints befor join**/
            'mute_upon_entry' => false,  /**close maic of clints befor join**/
            'waiting_room' => false,
            'approval_type' => config('zoom.approval_type'),
            'audio' => config('zoom.audio'),
            'auto_recording' => config('zoom.auto_recording')
        ]);

        $z=Online::create([
            "topic"=>$request->topic,
            "start_at"=>$request->start_time,
            "duration"=>$request->duration,
            "password"=>$request->password,
            "id_zoom"=>$user->meetings()->save($meeting)->id,
            "join_url"=>$user->meetings()->save($meeting)->join_url,
            "teacher_id"=>Auth::guard()->id(),
            "sub_material_id"=>$id_sub_material,
        ]);
        $z->all_sections()->attach($ids_of_sections);
            $data=" zoom Meeting in:$request->start_time
            password:$request->password";
            $n=new Notification();
            $n->content=$data;
            $n->save();
            $n->sections()->attach($ids_of_sections);
            foreach ($ids_of_sections as $id_section){
                event(new lecuterEvent($data,$id_section));
            }

        toastr()->success("Zoom Done");

        return  redirect()->route("zoom.lectures");



        }

        catch (\Exception $e){
            toastr()->error("حدث خطا");
            return  redirect()->back();
        }
    }
    public function zoom_lectures(){
        $notification=$this->get_notification();

        $zoom=Online::where("teacher_id",Auth::guard("teacher")->id())->get();
        return view("multiauth.teacher.pages.zoom_lectures",compact("zoom","notification"));
    }
    public function get_all_for_student(){

        $sub_materials=$this->get_notification_s()["materials"];
        $my_section_id=$this->get_notification_s()["section_id"];
        $notification=$this->get_notification_s()["notification"];
        $my_lectures_zoom = Online::whereHas('all_sections', function (Builder $query) use ($my_section_id) {
            $query->where('sections.id', "=",$my_section_id);
        })->get();
       return view("multiauth.student.pages.zoom_lectures",compact("sub_materials","my_lectures_zoom","notification","my_section_id"));
    }
}
