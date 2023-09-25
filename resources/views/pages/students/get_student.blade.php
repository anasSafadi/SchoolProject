@extends('layouts.master')
@section('css')

@section('title')

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')

<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @php
        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                $worlds=["add_section"=>"اضافة قسم","name_grade"=>"اسم المرحلة","name_class"=>"اسم الصف","name_section"=>"اسم القسم","add_student"=>"اضافة طالب جديد","name_student"=>"اسم الطالب","email"=>"الايميل","date_student"=>"تاريخ الميلاد","area"=>"مكان السكن","father"=>"الاب","password"=>"كلمة السر"];
        }
        else{

            $worlds=["add_section"=>"Add section","name_grade"=>"name grade","name_class"=>"name class","name_section"=>"name section","add_student"=>"Add Student","name_student"=>"Name of Student","email"=>"Email","date_student"=>"Date of Birth","area"=>"Area","father"=>"Father","password"=>"password"];
        }


    @endphp

    <style>
        span{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } label{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}

    </style>

    <style>
        td{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } button{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}

    </style>
    <br>
    <div class="card" style="border-radius: 10px">
        <div class="card-body" >
            <center><h4 style="font-weight: bold;font-family: 'Simplified Arabic';"> معلومات الطلبة في المدرسة</h4></center>
        </div>
    </div>
    <br>
    <br>

    <div class="card" style="border-radius: 10px">
    <div class="card-body" >
    <table id="datatable" class="table-bordered border table table-striped dataTable p-0">
        <thead>
        <tr>
            <th>اسم الطالب</th>
            <th>الصف الدراسي </th>
            <th>معلومات ولي الامر </th>
            {{--                                <th>االاقسام</th>--}}

        </tr>
        </thead>
        <tbody>
        @foreach($student as $item)
            <tr>
                <td> {{$item->name}} -  {{$item->email}} </td>
                {{--                                    {{$class->name_class}} {{$grade->name}}--}}
                <td>{{$item->my_class->name_class}} {{$item->my_class->grade->name}} - {{$item->my_section->name_section}}</td>
                <td>{{$item->parent->name_father ?? "NO DATA"}} - {{$item->parent->phone_father ?? "NO DATA"}}</td>


            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
    <!-- row closed -->

@endsection
@section('js')




@endsection
