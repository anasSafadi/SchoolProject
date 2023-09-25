<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $title_msg,$content_msg;

    public function __construct($title_m,$content_m)
    {
        $this->title_msg=$title_m;
        $this->content_msg=$content_m;
    }


    public function build(){
        $title=$this->title_msg;
        $msg=$this->content_msg;
        return $this->view("gmail_view_msg",compact('title','msg'));
    }
}
