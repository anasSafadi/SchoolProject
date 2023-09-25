@extends('layouts.master')
@section('css')

@section('title')

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> قائمة المواد الدرساية الموجودة</h4>
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

    <style>
        td{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } button{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}

    </style>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                        <u><h1></h1></u>



                            <h6>قائمة الاولاد الموجودين بالمدرسة</h6>
                            <div class="table-responsive">
                                <table id="datatable" class="table-bordered border table table-striped dataTable p-0">
                                    <thead>
                                    <tr>
                                        <th>اسم الطالب</th>
                                        <th>الصف</th>
                                        <th>العلامات</th>
                                        {{--                                <th>االاقسام</th>--}}

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($parent->sons as $student)
                                        <tr>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->my_class->name_class}}  {{ $student->my_class->grade->name }} - {{$student->my_section->name_section}}</td>
                                            <td>
                                                <?php $materials_name=[]; ?>
                                                @foreach($student->marks as $mark)
                                              <?php  $test=$mark->sub_material->material->name;

                                              $x=0;
                                              foreach ($materials_name as $item){
                                                  if ($item==$test){
                                                      $x++;
                                                  }
                                              }
                                              if ($x==0){
                                                  echo $test ."<br>";
                                                  array_push($materials_name,$test);
                                              }




                                              ?>
                                                        : {{$mark->mark ?? "error"}} / {{$mark->exam->questions->count() ?? "error"}}
                                                    <br>
                                                    @endforeach

                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        <hr/>



                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
