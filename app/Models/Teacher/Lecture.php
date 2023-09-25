<?php

namespace App\Models\Teacher;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $table="lectures";
    protected $guarded=[];
    public function all_sections(){
        return $this->belongsToMany("App\Models\Teacher\Section","lecture_section");
    }
    public function sub_material(){
        return $this->belongsTo("App\Models\Teacher\Sub_material","sub_material_id");
    }
    public function files(){
        return $this->morphMany(File::class,'fileable');
    }

    public function urls(){
        return $this->hasMany(URLS::class,'lecture_id');
    }
}
