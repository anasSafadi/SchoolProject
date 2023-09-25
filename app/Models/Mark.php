<?php

namespace App\Models;

use App\Models\Teacher\Sub_material;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $table="marks";
    protected $guarded=[];
    public function sub_material(){
        return $this->belongsTo(Sub_material::class,'sub_material_id');
    }
    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id');
    }
}
