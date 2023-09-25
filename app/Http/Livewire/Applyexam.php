<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Questions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Applyexam extends Component

{
    public $id_exam;
    public $previos_q;
    public $key=0;
    public  $all_questions;
    public $answer;
    public $keys;
    public $count=0;
    public $material_id;
    public $count_q; /**count questions**/
    public $rules=["answer"=>"required"];
    public $view_count_answer=0;
    public $view_count_questions=0;
    public $material_name;
    public function mount(){

        $exam=Exam::find($this->id_exam);
        $this->material_name=$exam->sub_material->material;
        $this->material_id=$exam->sub_material->id;
        $answers=Auth::guard("student")->student()->answers->where("exam_id",$this->id_exam);

        $questions=$exam->questions;
        $this->view_count_questions=$questions->count();
        $this->view_count_answer=$count_answers=$answers->count();
        /**case 1
        $count_answers>0&&$count_answers!=$questions->count()
         **/
        if ($count_answers>0&&$count_answers!=$questions->count()&&$count_answers<$questions->count()){
            foreach ($answers as $index=>$item){
                $last_of_q[$index]=$item->question_id;

            }

            $new_qustions= Questions::select('*')->where("exam_id",$this->id_exam)->whereNotin('id',$last_of_q)->get();
            $plus=0;
            foreach ($new_qustions as $index=>$value){
                $a[$plus]=$index;
                $plus++;
            }
            shuffle($a);
            $this->all_questions=$new_qustions;
            $this->keys=$a;
//        dd($this->all_questions->toArray());
//        dd($this->keys);
//            dd($this->keys[$this->key]);
            /**$this->all_questions[$this->keys[$this->key]]**/}
        /**$count_answers==0**/
        elseif($count_answers==0){
            $count_q=$questions->count();
            for($i=0;$i<$count_q;$i++){
                $a[$i]=$i;}
            shuffle($a);

            $this->all_questions=$questions;

            $this->keys=$a;
        }else{
            return abort(404);}

//        Answer::create([
//            'answer'=>'4040123456',
//            'student_id'=>Auth::guard("student")->id(),
//        ]);
    }
    public function render()
    {
        $index=$this->all_questions[$this->keys[$this->key]];

        return view('livewire.applyexam',[
            "question"=>$index,
        ]);

    }
    public function next_question(){

        $this->validate();
        $this->view_count_answer++;
        if($this->key!=count($this->keys)-1){
            /**$this->all_questions[$this->key]['id']**/
            Answer::create([
                'answer'=> $this->answer,
                'student_id'=>Auth::guard("student")->id(),
                "question_id"=>$this->all_questions[$this->keys[$this->key]]['id'],
                "exam_id"=>$this->id_exam]);
            $this->key++;
            $this->answer=null;
        }
        else {

            Answer::create([
                'answer'=>  $this->answer,
                'student_id'=>Auth::guard("student")->id(),
                "question_id"=>$this->all_questions[$this->keys[$this->key]]['id'],
                "exam_id"=>$this->id_exam]);
            $this->calculate_mark();
            return redirect()->route("show_lecture", $this->material_id);
        }
    }
    public function calculate_mark(){
        $exam=Exam::find($this->id_exam);
        $count_q=$exam->questions->count();
        $all_answers=Auth::guard("student")->student()->answers->where("exam_id",$this->id_exam);

        foreach ($all_answers as $item){
            if ($item->answer!=$item->the_question->answer){
                $count_q--;
            }
        }
        Mark::create([
            'mark'=>$count_q,
            'time'=>"2012-10-10",
            'active'=>"1",
            "sub_material_id"=> $this->material_id,
            'exam_id'=>$this->id_exam,
            'student_id'=>Auth::guard("student")->id(),
        ]);
    }
}
