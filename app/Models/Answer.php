<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table="answers";
    public function the_question(){
            return $this->belongsTo(Questions::class,"question_id");
    }
}
