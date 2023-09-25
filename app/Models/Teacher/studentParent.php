<?php

namespace App\Models\Teacher;

use App\Models\File;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class studentParent extends Authenticatable
{

    use HasFactory;
    protected $table="studentparents";
//    public $translatable = ['name_section'];
protected $guarded=[];
    public function my_area(){
        return $this->belongsTo("App\Models\Teacher\Area","area_father_id");
    }
    public function files(){
        return $this->morphMany(File::class,"fileable");
    }
    public function sons(){
        return $this->hasMany(Student::class,"parent_id");
    }
}
