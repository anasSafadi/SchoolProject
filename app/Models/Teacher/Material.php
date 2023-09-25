<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Material extends Model
{
    use HasTranslations;
    use HasFactory;
    protected $guarded=[];
    public $translatable = ['name'];
    protected $table='materials';
    public function teacher(){
        return $this->belongsTo("App\Models\Teacher","teacher_id");
    }
    public function sub_material(){
        return $this->hasMany("App\Models\Teacher\Sub_material","material_id");
    }


}
