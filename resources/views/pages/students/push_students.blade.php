@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> ncvlxcnvxcnvxcv</h4>
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
    @php
        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                $worlds=["from"=>"من","name_grade"=>"المرحلة","name_class"=>"الصف","name_section"=>"القسم","add_student"=>"اضافة طالب جديد","name_student"=>"اسم الطالب","email"=>"الايميل","date_student"=>"تاريخ الميلاد","area"=>"مكان السكن","father"=>"الاب","password"=>"كلمة السر"];
        }
        else{

            $worlds=["from"=>"From","name_grade"=>"name grade","name_class"=>"name class","name_section"=>"name section","add_student"=>"Add Student","name_student"=>"Name of Student","email"=>"Email","date_student"=>"Date of Birth","area"=>"Area","father"=>"Father","password"=>"password"];
        }

    @endphp
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">
{{--                        From--}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Grade_id">{{$worlds["from"]." ".$worlds["name_grade"]}} : <span class="text-danger">*</span></label>
                                /**1**/                                <select class="custom-select mr-sm-2" id="grade_id" onclick="get_class($(this).val())">
                                    <option selected disabled>Choose....</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="from_Classroom_id">{{$worlds["from"]." ".$worlds["name_class"]}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="from_classroom_id" onclick="get_sections($(this).val())">

                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="from_section_id">{{$worlds["from"]." ".$worlds["name_section"]}} : </label>
                                <select class="custom-select mr-sm-2" id="from_section_id">
                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div> </div>

{{--                        -----------------------to-----------------}}
                    <div class="row mt-5">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Grade_id">{{$worlds["name_grade"]}} : <span class="text-danger">*</span></label>
                                /**1**/                                <select class="custom-select mr-sm-2" id="grade_id" onclick="get_class($(this).val())">
                                    <option selected disabled>Choose....</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Classroom_id">{{$worlds["name_class"]}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="classroom_id" onclick="get_sections($(this).val())">

                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="section_id">{{$worlds["name_section"]}} : </label>
                                <select class="custom-select mr-sm-2" id="section_id">
                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div> </div>



                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <script>
        function get_class(id) {
            console.log(id);
            if(id>0){
                $.ajax({
                    type:'get',
                    url:'{{route('get_class_for_student')}}',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id,
                    },
                    success:function (data){
                        if(data.state==true){
                            console.log( data.items);
                            var list_class=document.getElementById("from_classroom_id");
                            list_class.innerHTML="<option selected disabled>Choose....</option>";
                            data.items.forEach(element =>list_class.innerHTML=list_class.innerHTML+"<option value="+element[0]+">" + element[1] + '</option>');

                        }

                    }
                });}
        }
        function get_sections(id) {
            console.log(id);
            if(id>0){
                $.ajax({
                    type:'get',
                    url:'{{route('get_sections_for_student')}}',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id,
                    },
                    success:function (data){
                        if(data.state==true){
                            console.log(data.items);
                            var list_class=document.getElementById("from_section_id");
                            list_class.innerHTML="<option selected disabled>Choose....</option>";
                            data.items.forEach(element =>list_class.innerHTML=list_class.innerHTML+"<option value="+element[0]+">" + element[1] + '</option>');

                        }

                    }
                });}
        }
    </script>

@endsection
