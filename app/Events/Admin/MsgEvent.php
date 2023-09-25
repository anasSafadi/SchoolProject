<?php

namespace App\Events\Admin;

use App\Models\send_admin_to_teacher;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MsgEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $id_teacher,$title_msg,$content_msg,$insert_msg_id;
    public function __construct($id_of_teacher,$title_of_msg,$content_of_msg,$insert_of_msg_id)
    {
        $this->id_teacher=$id_of_teacher;
        $this->title_msg=$title_of_msg;
        $this->content_msg=$content_of_msg;
        $this->insert_msg_id=$insert_of_msg_id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        $msg_in_db=send_admin_to_teacher::find($this->insert_msg_id)->increment('web_count_receivers');

        return new PrivateChannel("teacher.$this->id_teacher");
    }
}
