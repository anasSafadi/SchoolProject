<?php

namespace App\Models\Teacher;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_material extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table='sub_material';
    public function teacher(){
        return $this->belongsTo("App\Models\Teacher","teacher_id");
    }
    public function material(){
        return $this->belongsTo("App\Models\Teacher\Material","material_id");
    }
    public function class_room_of_material(){
        return $this->belongsTo("App\Models\Teacher\Classroom","classroom_id");
    }

    public function lectures(){
        return $this->hasMany("App\Models\Teacher\Lecture","sub_material_id");
    }
    public function exams(){
        return $this->hasMany(Exam::class,"sub_material_id");
    }
    public function Presence_and_absence(){
        return $this->hasMany("App\Models\Teacher\presence_absence","sub_material_id");
    }
    public function home_works(){
        return $this->hasMany("App\Models\Teacher\Home_work","sub_material_id");
    }

}
