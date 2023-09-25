<?php
namespace App\Http\Traits;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

trait teacher_get_notification{

    public function get_notification(){

        return Teacher::find(Auth::guard("teacher")->id())->my_notifications->toArray();
    }
}
