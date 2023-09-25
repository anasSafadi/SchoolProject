@extends('layouts.master')
@section('css')

@section('title')

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <style>
        td{font-family: "Simplified Arabic";font-weight: bold;font-size: 14px}
        label{font-family: "Simplified Arabic";font-weight: bold;font-size: 14px}
        h5{font-family: "Simplified Arabic";font-weight: bold;font-size: 18px}
    </style>
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> ALL EXAMS</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Page Title</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">

                        @foreach($sub as $x=>$material)
                            @if($material->exams->count()>0)
                            <u><h5> - {{$material->material->name}} {{$class=$material->class_room_of_material->name_class}} {{$material->class_room_of_material->grade->name}}</h5></u>
                            <table id="datatable" class="table table-hover table- table-bordered p-0" data-page-length="50"
                                   style="text-align: center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان الاختبار</th>
                                    <th>الاقسام</th>
                                    <th>عدد الاسئلة الكلي</th>
                                    <th>عدد الاسئلة المجاب علبها</th>
                                    <th>الحالة</th>
                                    <th>ملاحظات</th>
                                    <th>سجل العلامات</th>
                                </tr>
                                </thead>
                                <tbody>


{{--                                /**exaaaaaaam**/--}}
                                @foreach($material->exams as $exam)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$exam->title ?? $material->material->name}}</td>
                                        <td>
                                            @foreach($exam->sections as $section)

                                                {{$class}} {{$section->class_room_of_section->grade->name}} -{{$section->name_section}} <br>
                                                @if($loop->last)مادة
                                                    {{$material->material->name}}
                                                @endif
                                            @endforeach

                                        </td>
                                        <td>{{$exam->questions->count()}}</td>
                                        <td>{{$exam->questions->wherenotnull("answer")->count()}}</td>

                                        <td>
                                            @if($exam->state=="0")
                                                <i class="fa fa-circle text-danger"></i>
                                                @else
                                                <i class="fa fa-circle text-success"></i>
                                                <label>تم</label> <i class="fa fa-check  text-success"></i>
                                                @endif
                                        </td>
                                        <td>


                                            @if($exam->state=="0")
                                                <a class="btn btn-add-todo" href="{{route("delete_exam_by_teacher",$exam->id)}}" style="border-radius: 40px;">  <div><label>حذف الاختبار</label> <i class="fa fa-trash text-danger"></i></div></a>
                                            @else
                                                <label class="text-warning">لايمكنك الحذف</label>


                                            @endif

                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            اعدادت الاختبار
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">



                                                            <a class="dropdown-item" href="{{route("get_marks",$exam->id)}}" style="border-radius: 40px;">  <div><label>العلامات</label> <i class="fa fa-question text-danger"></i></div></a>

                                                            @if($exam->state=="0")

                                                                <a href="{{route('public_exam',$exam->id)}}" class="dropdown-item">رفع الاختبار للطلاب</a>
                                                            @else
                                                                <a href="{{route('private_exam',$exam->id)}}" class="dropdown-item">private_exam</a>

                                                            @endif

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-6">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            اعدادت الاسئلة
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            @if($exam->state=="0")
                                                                <a class="btn btn-add-todo" href="{{route("add_question",$exam->id)}}" style="border-radius: 40px;">  <div><label>سؤال جديد</label> <i class="fa fa-question text-danger"></i></div></a>

                                                            @endif


                                                            <a class="dropdown-item" href="{{route("show_questions",$exam->id)}}" style="border-radius: 40px">  <label >اظهار الاسئلة</label> <i class="fa fa-eye text-info"></i></a>
                                                            <a class="dropdown-item" href="{{route("show_questions",$exam->id)}}" style="border-radius: 40px">  <label >الاجابة عن الاسئلة</label> <i class="fa fa-inbox text-info"></i></a>


                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
{{--                                end exam--}}



                            </table>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
