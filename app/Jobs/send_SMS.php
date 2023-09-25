<?php

namespace App\Jobs;

use App\Models\send_admin_to_teacher;
use App\Models\Teacher;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class send_SMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $ids,$title_msg,$content_msg,$id_msg;

    public function __construct($all_ids,$title_m,$content_m,$id_of_msg)
    {
        $this->ids=$all_ids;
        $this->title_msg=$title_m;
        $this->content_msg=$content_m;
        $this->id_msg=$id_of_msg;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->ids as $id_teacher){
            $phone=Teacher::find($id_teacher)->phone;
            $msg_in_db=send_admin_to_teacher::find($this->id_msg)->increment('sms_count_receivers');
Http::get("https://www.tweetsms.ps/api.php?comm=sendsms&api_key=a92a856cbb9e06f61c87208fc56c820e&to=$phone&message=$this->content_msg&sender=karawan");


        }
    }
}
