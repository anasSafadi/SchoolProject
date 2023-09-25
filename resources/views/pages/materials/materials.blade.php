@extends('layouts.master')

    <link href="{{asset('/filepond/filepond.css')}}" rel="stylesheet" />

@section('content')
    <!-- row -->
    @php
        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                $worlds=["add_section"=>"اضافة قسم","name_grade"=>"اسم المرحلة","name_class"=>"اسم الصف","name_section"=>"اسم القسم","add_student"=>"اضافة مادة جديد","name_student"=>"اسم المادة","email"=>"الايميل","date_student"=>"تاريخ الميلاد","area"=>"مكان السكن","father"=>"الاب","password"=>"كلمة السر"];
        }
        else{

            $worlds=["add_section"=>"Add section","name_grade"=>"name grade","name_class"=>"name class","name_section"=>"name section","add_student"=>"Add Material","name_student"=>"Name of Material","email"=>"Email","date_student"=>"Date of Birth","area"=>"Area","father"=>"Father","password"=>"password"];
        }

    @endphp

    <style>
        option{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } label{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}
        option{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;}

    </style>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">

                <div class="card-body">

                    <h4>
                اضافة مادة جديد للمدرسة
                    </h4>
                </div>
            </div></div>
    </div>
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

                    <form method="post"  action="">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{$worlds["add_student"]}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["name_student"]}}(AR) : <span class="text-danger">*</span></label>
                                    <input  type="text" name="name_ar"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["name_student"]}}(EN) : <span class="text-danger">*</span></label>
                                    <input  class="form-control" name="name_en" type="text" >
                                </div>
                            </div>
                        </div>


                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">معلومات المادة الجديدة</h6><br>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-left " onclick="test()" type="submit" id="save_data">Register</button>

                </div>
            </div></div>
    </div>



                        @foreach($grades as $x=>$grade)
                            <div class="row" id="grade_{{$x}}">
                                <div class="col-md-12 mb-30">
                                    <div class="card card-statistics h-100">
                                        <div class="card-body">
                           <u> <h4 class="col mt-20">
{{--                             <input class="parent_checkbox" type="checkbox" id="grade_{{$grade->id}}" value="{{$grade->id}}" onclick="grades({{$grade->id}})">--}}

                                    {{$grade->name}}</h4></u>


                            <div class="row">

                             @foreach($grade->all_class_rooms as $classrooms)

                                    <div class="remember-checkbox mb-20 col">
                                        <input class="parent_checkbox" type="checkbox" id="row_{{$classrooms->id}}" value="{{$classrooms->id}}">
                                        <label class="form-check-label" for="row_{{$classrooms->id}}">
                                            {{$classrooms->name_class}} - {{$grade->name}}</label>

                                                <p class="m-4">المدرس : <span class="text-danger">*</span></p>
                                                <select class="custom-select mr-sm-2">
                                                    <option selected disabled>Choose...</option>
                                                    @foreach($teachers as  $teacher)
                                                        <option value="{{$teacher->id}}">{{$teacher->name}}</option>

                                                    @endforeach

                                                </select>


                                    </div>


                                 @endforeach
                            </div>
                          ____________________________________________________________________________________________________

                                            <br> <br> <br> <label onclick="hidden_div({{$x}})"  class="btn btn-danger" >هذه المرحلة غير مدرجة</label>


                                        </div>
                                    </div></div>
                            </div>
                        @endforeach



                        <hr>
                        <input  type="text"  hidden id="my_teachers_ids" name="my_teachers_ids"/>
                        <input  type="text" hidden id="my_all_class_rooms" name="my_all_class_rooms"/>

                    </form>


    <script src="{{asset('https://code.jquery.com/jquery-3.6.3.min.js')}}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

@endsection
@section('js')







    <script>
        function hidden_div(x) {
            console.log(x);
            window.alert("Are you sure ?")
            document.getElementById("grade_"+x).style.display = 'none';
            window.alert("نجاح")

        }
        function  test() {
            my_teachers=[];
            my_class=[];
            let all_teachers=document.getElementsByClassName("custom-select mr-sm-2");
            for (var i = 0; i < all_teachers.length; i++) {
                console.log(all_teachers[i].value);
                if(all_teachers[i].value>0){
                my_teachers.push(all_teachers[i].value)}
            }

            let all_class_rooms=document.getElementsByClassName("parent_checkbox");
            for (var ii = 0; ii < all_class_rooms.length; ii++) {
                console.log(all_class_rooms[ii].value);
                if(all_class_rooms[ii].value>0 && all_class_rooms[ii].checked == true){

                    my_class.push(all_class_rooms[ii].value)}
            }
            console.log(my_teachers);
            console.log(my_class);
            // console.log(my_teachers);

                var input1=document.getElementById('my_all_class_rooms');
                        input1.value=my_class;
                var inputs2=document.getElementById("my_teachers_ids");
                      inputs2.value=my_teachers;





        }
    </script>

@endsection
