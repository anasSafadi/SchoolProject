<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class test implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $n1;
    public $id=1;
    public $n2;
    public function __construct($data,$id)
    {
        $this->n1=$data["n1"];
        $this->n2=$data["n2"];
        $this->id=$id;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function broadcastOn()
    {
        return new PrivateChannel("test.$this->id");
    }
//    public function broadcastWith()
//    {
//        return ['ff' => "fff"];
//    }
    public function broadcastWhen()
    {
        return 400 > 100;
    }
}
