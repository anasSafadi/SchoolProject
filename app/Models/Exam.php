<?php

namespace App\Models;

use App\Models\Teacher\Section;
use App\Models\Teacher\Sub_material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="exams";
    public function sub_material(){
        return $this->belongsTo(Sub_material::class,"sub_material_id");
    }
    public function questions(){
        return $this->hasMany(Questions::class,"exam_id");
    }
    public function sections(){
        return $this->belongsToMany(Section::class,"sections_exam","exam_id","section_id");
    }
    public function mark_of_this_exam(){
        return $this->hasOne(Mark::class,"exam_id")->where("active","=","1")->where("student_id","=",Auth::guard("student")->id());
    }
}
