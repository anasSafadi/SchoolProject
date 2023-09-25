<?php

namespace App\Http\Controllers\Exams;

use App\Http\Controllers\Controller;
use App\Http\Traits\student_get_notification;
use App\Models\Exam;
use App\Models\Questions;
use App\Models\Teacher;
use App\Models\Teacher\Sub_material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    use student_get_notification;
    public function new_exam(){
        $ids_of_grades=[];
        $id=Auth::guard("teacher")->id();
        $teacher=Teacher::find($id);
        $my_grades =DB::table('sub_material')->select("grade_id")->where("teacher_id",$id)->distinct()->get();

        foreach ($my_grades as $grade){
            array_push($ids_of_grades, $grade->grade_id);
        }
        $grades=Teacher\Grade::find($ids_of_grades);
        return view("multiauth.teacher.exam.new_exam",compact('grades'));
    }
    public function store_exam(Request $request){
        try{
            $exam=new Exam();
            $exam->sub_material_id=$request->sub_id;
            $exam->save();
            $exam->sections()->attach($request->sections_ids);
            return response()->json(['state'=>true,"msg"=>"Done"]);
        }catch (\Exception $e){
            return response()->json(['state'=>false]);
        }
    }
    public function get_all_exams(){
        $sub=Sub_material::where("teacher_id",Auth::guard("teacher")->id())->get();
     return view("multiauth.teacher.exam.list_exams",compact('sub'));
    }



    public function add_question($id_exam){
        $exam=Exam::findorfail($id_exam);
        if ($exam->state=="1"){
            toastr()->info("لا يمكنك اضافة اسئلة تم  نشر هذا الاختبار");
            return redirect()->back();
        }
        else{

            return view("multiauth.teacher.exam.add_question",compact('exam'));
        }
    }

    public function store_question(Request $request){
        $q=Questions::create([
            "question"=>$request->question,
            "options"=>$request->options,
            "exam_id"=>$request->exam_id,
        ]);

        return response()->json(["state"=>true]);
    }

    public function show_questions($id_exam){
       $questions=Exam::findorfail($id_exam)->questions;
        return view("multiauth.teacher.exam.show_questions",compact('questions',"id_exam"));

    }
    public function store_answers(Request $request){
        $data=$request->except("_token");

       $ids_all_questions=[];
        foreach ($data as $key=>$value){
           array_push($ids_all_questions,$key);
        }

        $all_question=Questions::find($ids_all_questions);


        foreach ($all_question as $key=>$question){
            $question->answer=$data[$question->id];
            $question->save();
        }
        return redirect()->back();

    }
    public function public_exam($id_exam){
        $exam=Exam::findorfail($id_exam);
        $count_answers= DB::select("select count('answer') as count_answers from questions where exam_id='$id_exam' and answer is not null");
        if($count_answers[0]->count_answers==$exam->questions->count()&&$exam->state!="1"){
            $exam->state="1";
            $exam->save();
            toastr()->success("تم نشر هذا الاختبار");
            return redirect()->route("get_all_exams");
        }
        elseif ($count_answers[0]->count_answers!=$exam->questions->count()){
            toastr()->error("الاختبار عير مكتمل الاجابات");
            return redirect()->back();
        }
        else{
            toastr()->info("تم نشر هذا الاختبار مسبقا");
            return redirect()->back();
        }

    }
    public function private_exam($id_exam){
        $exam=Exam::findorfail($id_exam);
        $exam->state="0";
        $exam->save();
            toastr()->info("EXAM IN PRIVATE");
            return redirect()->back();


    }
    public function get_marks($id_exam){
        $exam=Exam::find($id_exam);
        $marks=DB::select("select * from students left join marks on students.id=marks.student_id and marks.exam_id=$id_exam order by marks.mark DESC ");

        return view('multiauth.teacher.exam.get_marks',compact('marks',"exam"));
    }
    /**-------------------------------student_side---------------------**/
    public function apply_exam($id_exam){
        $my_section_id=$this->get_notification_s()["section_id"];
        $notification=$this->get_notification_s()["notification"];
        $sub_materials=$this->get_notification_s()["materials"];
        $material_name=Exam::find($id_exam)->sub_material->material;

       return view("multiauth.student.pages.exam.apply_exam",compact('material_name','sub_materials','id_exam','my_section_id','notification'));
    }
    public function delete_exam_by_teacher($id_exam){
        $e=Exam::destroy($id_exam);
        toastr()->info("Delete Done");
        return redirect()->back();
    }

}
