<?php

namespace App\Models;

use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignment_delivery extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="assignment_delivery";
    public function home_work(){
        return $this->belongsTo("app\App\Models\Teacher\Home_work","home_work_id");
    }
    public function files(){
        return $this->morphMany(File::class,"fileable");
    }
    public function student(){
        return $this->belongsTo(Student::class,"student_id");
    }
//    public function home_work(){
//        return $this->belongsTo("app\App\Models\Teacher\Home_work","home_work_id");
//    }
}
