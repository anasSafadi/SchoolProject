<?php

namespace App\Jobs;

use App\Mail\Admin\AdminMail;
use App\Models\send_admin_to_teacher;
use App\Models\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class send_mail_to_teacher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $ids,$title_msg,$content_msg,$id_msg;

    public function __construct($all_ids,$title_m,$content_m,$id_of_msg)
    {
        $this->ids=$all_ids;
        $this->title_msg=$title_m;
        $this->content_msg=$content_m;
        $this->id_msg=$id_of_msg;
    }


    public function handle()
    {
             foreach ($this->ids as $id_teacher){
                 $email=Teacher::find($id_teacher)->email;
                 Mail::to($email)->send(new AdminMail($this->title_msg,$this->content_msg));
                 $msg_in_db=send_admin_to_teacher::find($this->id_msg)->increment('gmail_count_receivers');


             }

    }
}
