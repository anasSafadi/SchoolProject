<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_Notification extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="teacher_notification";
    public function teachers(){
        return $this->belongsToMany("App\Models\Teacher","tnotification_teacher","teacher_notification_id","teacher_id");
    }
}
