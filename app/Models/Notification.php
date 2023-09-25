<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table="notification";
    protected $guarded=[];
    public function sections(){
        return $this->belongsToMany("App\Models\Teacher\Section","notification_section");
    }

}
