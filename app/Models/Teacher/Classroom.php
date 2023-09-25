<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $guarded=[];
    public $translatable = ['name_class'];
    protected $table="classrooms";

    public function grade(){
        return $this->belongsTo("App\Models\Teacher\Grade","grade_id");
    }
    public function all_sections(){
        return $this->hasMany("App\Models\Teacher\Section","classroom_id");
    }
    public function sub_material(){
        return $this->hasMany("App\Models\Teacher\Sub_material","classroom_id");
    }
    public function students(){
        return $this->hasMany("App\Models\Student\Student","classroom_id");
    }
}
