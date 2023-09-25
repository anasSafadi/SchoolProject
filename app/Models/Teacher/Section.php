<?php

namespace App\Models\Teacher;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    use HasFactory;
    protected $guarded=[];
    public $translatable = ['name_section'];
    protected $table='sections';
    public function class_room_of_section(){
        return $this->belongsTo("App\Models\Teacher\Classroom","classroom_id");
    }
    public function teachers(){
        return $this->belongsToMany("App\Models\Teacher","section_teacher");
    }
    public function students(){
        return $this->hasMany("App\Models\Student\student","section_id");
    }
    public function Presence_and_absence(){
        return $this->hasMany(presence_absence::class,"section_id");
    }

    public function lectures(){
        return $this->belongsToMany("App\Models\Teacher\Lecture","lecture_section");
    }
    public function homeworks(){
        return $this->belongsToMany("App\Models\Teacher\Home_work","assessment_sections","section_id","home_work_id");
    }
    public function exams(){
        return $this->belongsToMany(Exam::class,"sections_exam","section_id","exam_id");
    }
}
