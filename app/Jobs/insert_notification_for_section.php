<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class insert_notification_for_section implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public  $sections_ids=[];
  public $data;
    public function __construct($all_sections_ids,$text)
    {
       $this->sections_ids=$all_sections_ids;
       $this->data=$text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $n=new Notification();
        $n->content=$this->data;
        $n->save();
        $n->sections()->attach($this->sections_ids);
    }
}
