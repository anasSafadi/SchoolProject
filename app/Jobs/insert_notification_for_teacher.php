<?php

namespace App\Jobs;

use App\Models\Teacher\Teacher_Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class insert_notification_for_teacher implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public  $title_msg,$content_msg;
    public $ids_teacher=[];
    public function __construct($title,$content,$my_ids)
    {
        $this->title_msg=$title;
         $this->content_msg=$content;
        $this->ids_teacher=$my_ids;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $t=new Teacher_Notification();
       $t->content=$this->title_msg.$this->content_msg;
       $t->save();
       $t->teachers()->attach($this->ids_teacher);
    }
}
