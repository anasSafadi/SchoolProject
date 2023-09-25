<?php

namespace App\Repository;
use App\Models\Teacher;

class StudentsRepository implements StudentsRepositoryInterface{

    public function add_student(){
        $data["grades"]=Teacher\Grade::all();
        $data["parents"]=Teacher\studentParent::all();
        $data["areas"]=Teacher\Area::all();
        return view("pages.students.add_student",compact("data"));
    }


}
