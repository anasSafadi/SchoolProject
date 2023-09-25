<?php

namespace App\Models\Teacher;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    use HasFactory;
    protected $guarded=[];
    public $translatable = ['name'];
    protected $table='grades';

    public function all_class_rooms(){
        return $this->hasMany("App\Models\Teacher\Classroom","grade_id");
    }

    public function students(){
        return $this->hasMany("App\Models\Student\Student","grade_id");
    }
}
