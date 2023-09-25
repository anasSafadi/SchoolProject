<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pushup extends Model
{
    use HasFactory;
    protected $table="puhsup";
    protected $guarded=[];
//    public function section(){
//        return $this->belongsTo("App\Models\Teacher\Classroom","classroom_id");
//    }
}
