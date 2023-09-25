<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="online_lectures";
    public function all_sections(){
        return $this->belongsToMany("App\Models\Teacher\Section","zoom_sections");
    }
    public function zoom_sub_material(){
        return $this->belongsTo("App\Models\Teacher\Sub_material","sub_material_id");
    }
}
