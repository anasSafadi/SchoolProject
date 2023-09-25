<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presence_absence extends Model
{
    use HasFactory;
    protected $table="presence_absence";
    protected $guarded=[];
    public function students(){
        return $this->belongsToMany("App\Models\Student\student","presenceabsence_students","presence_absence_id","student_id");
    }
}
