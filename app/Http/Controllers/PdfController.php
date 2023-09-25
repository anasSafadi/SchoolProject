<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function make_exam($id_exam){



        $exam=Exam::find($id_exam);
        $class=$exam->sub_material->class_room_of_material;
        $class_name=$class->name_class;
        $grade_name=$class->grade->name;

        $exam_name="اختبار مادة ".$exam->sub_material->material->name."".$class_name."".$grade_name;
        $filesname="$exam_name.pdf";
        $questions=$exam->questions->toArray();
        $html=view('pdf.exam',compact('questions'));
        $pdf=new PDF;
        $pdf::SetTitle("title padf");
        $pdf::AddPage();
        $pdf::SetFont('aealarabiya', '', 10);
        $pdf::WriteHTML($html,true,false,true,false,"");
        $pdf::Output(public_path($filesname),"F");
        return response()->download(public_path($filesname));
    }
}
