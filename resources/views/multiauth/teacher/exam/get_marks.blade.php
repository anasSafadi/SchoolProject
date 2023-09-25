@extends('layouts.master')
@section('css')

@section('title')
    ALL MARKS OF STUDENT
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-10" style="margin-top: 10px"> علامات اختبار مادة {{$exam->sub_material->material->name}}</h4>
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
                    <table id="datatable" class="table table-hover table- table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الطالب</th>


                            <th>عدد الاسئلة المجاب علبها</th>
                            <th>الدرجة</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($marks as $mark)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td> <?php
                                $a=explode(",",$mark->name);
                                    echo  explode(":",$a[0])[1];
                               ?> </td>
                                <td> <td> {{$mark->mark ?? "لا يوجد علامة مدرجة (لم يتم تقديم الاختبار بواسطة هذا الطالب)"}}</td></td>

                            </tr>
                            @endforeach

                        </tbody>




                    </table>
                              </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
