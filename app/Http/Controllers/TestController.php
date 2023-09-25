<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Questions;
use Illuminate\Http\Request;
use function Symfony\Component\HttpFoundation\Session\Storage\save;

class TestController extends Controller
{
    public $arr=["first","two","trheee"];
    private $x=0;
    public function index(){


        dd("done");
        $test=new TestController();
        return view("test",compact('test'));
    }
    public function set_name(Request $request){
        $this->x=$this->x+1;
        return response()->json(['state'=>true,"data"=>$this->arr[$this->x],"x"=>$this->x]);
    }

}
