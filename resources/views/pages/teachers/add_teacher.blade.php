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
                <h4 class="mb-0"> اضافة معلم جديد اللى المدرسة</h4>
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
    @php
        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                $worlds=["add_section"=>"اضافة قسم","name_grade"=>"اسم المرحلة","name_class"=>"اسم الصف","name_section"=>"اسم القسم","add_student"=>"اضافة معلم جديد","name_student"=>"اسم المعلم","email"=>"الايميل","date_student"=>"تاريخ الميلاد","spe"=>"التخصص","father"=>"الاب","password"=>"كلمة السر","phone"=>"رقم الهاتف"];
        }
        else{

            $worlds=["add_section"=>"Add section","name_grade"=>"name grade","name_class"=>"name class","name_section"=>"name section","add_student"=>"Add Teacher","name_student"=>"Name of Teacher","email"=>"Email","date_student"=>"Date of Birth","spe"=>"Soecilts","password"=>"password","phone"=>"phone"];
        }

    @endphp

    <style>
        span{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } label{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}

    </style>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post"  action="{{route("add-teacher")}}">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{$worlds["add_student"]}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["name_student"]}}(AR) : <span class="text-danger">*</span></label>
                                    <input  required type="text" name="name_ar"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["name_student"]}}(EN) : <span class="text-danger">*</span></label>
                                    <input  required class="form-control" name="name_en" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["email"]}} : </label>
                                    <input  required type="email"  name="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["password"]}} :</label>
                                    <input  required  type="password" name="password" class="form-control" >
                                </div>
                            </div>



                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nal_id" id="area">{{$worlds["spe"]}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="spe">
                                        <option selected disabled>Choose...</option>
                                        @foreach($spe as  $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{$worlds["date_student"]}}  :</label>
                                    <input  required class="form-control" type="date"  name="date" />
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{$worlds["phone"]}}  :</label>
                                <input required class="form-control" type="text"  name="phone" autocomplete="f"/>
                            </div>

                                    </div>

                        <hr>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" style="font-size: 20px">ارسل</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
