<?php

namespace App\Models\Student;



use App\Models\File;
use App\Models\Mark;
use App\Models\Teacher\Classroom;
use App\Models\Teacher\presence_absence;
use App\Models\Teacher\Section;
use App\Models\Teacher\studentParent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use HasTranslations;
    use HasFactory;
    protected $table="students";
    protected $guarded=[];
    public $translatable = ["name"];
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function my_class()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function my_section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function parent()
    {
        return $this->belongsTo(studentParent::class, 'parent_id');
    }
//    public function Presence_and_absence(){
//        return $this->belongsToMany(Presence_absence::class,"presenceabsence_students","student_id","presence_absence_id","active");
//    }
    public function Presence_and_absence(){
        return $this->belongsToMany(Presence_absence::class,"presenceabsence_students")->withPivot("student_id","presence_absence_id","active");  }
    public function answers(){
        return $this->hasMany("App\Models\Answer","student_id");
    }
    public function marks(){
        return $this->hasMany(Mark::class,"student_id");
    }
}
