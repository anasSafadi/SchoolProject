<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;
    protected $table="questions";
    protected $guarded=[];
    public function exam(){
        return $this->belongsTo(Exam::class,"exam_id");
    }
    protected $casts = [
        'options' => 'array',
    ];
}
