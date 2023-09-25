<?php

namespace App\Http\Controllers\MSG\Admin;

use App\Events\Admin\MsgEvent;
use App\Http\Controllers\Controller;
use App\Jobs\insert_notification_for_teacher;
use App\Jobs\send_mail_to_teacher;
use App\Jobs\send_SMS;
use App\Models\send_admin_to_teacher;
use App\Models\Teacher\Teacher_Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class MsgController extends Controller
{

   public function send_msg_to_teachers(Request $request){

       $title_msg=$request->title_msg;
       $content_msg=$request->content_msg;
       $ids= $request->ids_of_teachers;

       $validation=Validator::make($request->all(),[
           "title_msg"=>"required",
           "content_msg"=>"required",
           'ids_of_teachers'=>"required",
           "broker"=>"required",
       ]);
       if ($validation->fails()){
           return response()->json(["state"=>false,"msg"=>"المعلموات غير كافية"]);
       }


       $insert_msg=send_admin_to_teacher::create([
           "title_msg"=>$title_msg,"content_msg"=>$content_msg,"total_count_receivers"=>count($ids)]);

       insert_notification_for_teacher::dispatch($title_msg,$content_msg,$ids);
//       100 web
//       200 gmail
       if (isset($request->broker)){
//           switch ($request->broker) {
//               case array_search("100",$request->broker)>-1:
//                   return "100";
//                   break;
//               case array_search("200",$request->broker)>-1:
//                   echo "i equals 1";
//                   break;
//               case "300":
//                   echo "i equals 2";
//                   break;
//           }
//        -----------------------   first _if-------------------
           if(array_search("100",$request->broker)>-1){
               $insert_msg->web_count_receivers="0";
               $insert_msg->save();



             foreach ($ids as $id_of_teacher){

                 event(new MsgEvent($id_of_teacher,$title_msg,$content_msg,$insert_msg->id));

             }
             if (count($request->broker)==1){
                 return response()->json(["state"=>true,"msg"=>"SENDING DONE web"]);
             }


           }
//           -----------------------   first _if-------------------
//           -----------------------   second _if-------------------
           if(array_search("200",$request->broker)>-1){
               $insert_msg->gmail_count_receivers="0";
               $insert_msg->save();

            send_mail_to_teacher::dispatch($ids,$title_msg,$content_msg,$insert_msg->id);

               if (count($request->broker)==1){
                   return response()->json(["state"=>true,"msg"=>"SENDING DONE gmail"]);
               }

               return response()->json(["state"=>true,"msg"=>"SENDING DONE gmail"]);
           }
//                 -----------------------   second _if-------------------
           if(array_search("300",$request->broker)>-1){
               $insert_msg->sms_count_receivers="0";
               $insert_msg->save();

              send_SMS::dispatch($ids,$title_msg,$content_msg,$insert_msg->id);

               return response()->json(["state"=>true,"msg"=>"SENDING DONE"]);

           }



       }
       else{
           return response()->json(["state"=>false,"msg"=>"المعلموات غير كافية"]);

       }


   }
   public function get_all_messages(){

       $msg=send_admin_to_teacher::orderBy("id","asc")->get();
       return view("pages.msg.list_msg",compact('msg'));
   }
   public function delete_all_msg_from_admin(){

       DB::table("jobs")->delete();
       DB::table("send_admin_to_teacher")->delete();
       toastr()->success("تم الحذف");
       return redirect()->back();
   }
}
