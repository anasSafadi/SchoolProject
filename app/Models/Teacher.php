<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    use HasTranslations;

    protected $guarded=[];
    public $translatable = ["name"];
    protected $table="teachers";
    public function sections(){
        return $this->belongsToMany("App\Models\Teacher\Section","section_teacher");
    }
    public function sub_materials(){
        return $this->hasMany("App\Models\Teacher\Sub_material","teacher_id");
    }

    public function my_notifications(){
        return $this->belongsToMany("App\Models\Teacher\Teacher_Notification","tnotification_teacher","teacher_id","teacher_notification_id");
    }

}
