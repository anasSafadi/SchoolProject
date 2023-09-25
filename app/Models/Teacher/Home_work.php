<?php

namespace App\Models\Teacher;

use App\Models\assignment_delivery;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home_work extends Model
{
    use HasFactory;
    protected $table="home_work";
    protected $guarded=[];
    public function files()
    {
        return $this->morphMany(File::class,'fileable');

    }
    public function sections(){
        return $this->belongsToMany(Section::class,"assessment_sections","home_work_id","section_id");
    }

    public function assignment_delivery(){
        return $this->hasMany(assignment_delivery::class,"home_work_id");
    }
}
