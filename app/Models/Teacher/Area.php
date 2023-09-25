<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Area extends Model
{
    use HasFactory;
    use HasTranslations;
    protected $table="areas";
    public $translatable = ["name_area"];
    protected $guarded=[];

}
