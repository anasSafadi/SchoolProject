@extends('layouts.master')
@section('css')

@section('title')

@stop
@endsection
@section('page-header')
    @php
        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                $worlds=["add_section"=>"اضافة قسم","name_grade"=>"اسم المرحلة","name_class"=>"اسم الصف","name_section"=>"اسم القسم"];
        }
        else{

            $worlds=["add_section"=>"Add section","name_grade"=>"name grade","name_class"=>"name class","name_section"=>"name section"];
        }

    @endphp

    <style>
        td{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } button{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}


    </style>

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <button type="button" class="btn btn-danger mt-20 mb-10" data-toggle="modal" data-target="#exampleModal">{{$worlds["add_section"]}}</button>


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
    @isset($grades)
        @foreach($grades as $grade)
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <h5 class="card-title"> المرحلة {{$grade->name}}</h5>
                        <div class="accordion plus-icon shadow">
                            @if($grade->all_class_rooms)
                                @foreach($grade->all_class_rooms as $class_room)
                                    <div class="acd-group">
                                        <a href="#" class="acd-heading" style="font-weight: bold;font-size: 18px">اقسام  {{$class_room->name_class}} - {{$grade->name}}</a>
                                        <div class="acd-des">
                                            <table class="table border" >
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">القسم</th>
                                                    <th scope="col">عدد طلاب القسم</th>
                                                    <th scope="col">ملاحظات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($class_room->all_sections as $section)
                                                    <tr>
                                                        <th scope="row">{{$loop->iteration}}</th>
                                                        <th>{{$section->class_room_of_section->name_class}} {{$section->class_room_of_section->grade->name}}-{{$section->name_section}} </th>


                                                        <td>
                                                            {{$section->students->count() ?? "00"}}
                                                         </td>
                                                         <td>
                                                             <a href="{{route("delete_section",$section->id)}}"
                                                               class="btn btn-outline-danger btn-sm">حذف القسم</a>



                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table></div>
                                    </div>
                                @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>

            <hr/>
        @endforeach
    @endisset</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">

                    {{$worlds["add_section"]}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{route("add_section")}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">

                            <label  class="mr-sm-2">اسم القسم (AR):</label>
                            <input  type="text" name="name_section_ar" class="form-control">
                        </div>
                        <div class="col">
                            <label for="Name_en" class="mr-sm-2">اسم القسم (EN)</label>
                            <input type="text" class="form-control" name="name_section_en">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputState" class="m-2">{{$worlds["name_grade"]}}</label>
                        <select class="form-select" required  onclick="get_sections($(this).val())" name="grade_of_section">
                            <option>select</option>
                            @foreach($grades as $grade)
                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputState"class="m-2">الصف الدراسي</label>
                        <select class="form-select" id="result_grade" name="class_of_section" required>
                            <option>الصف</option>

                            <option >nothing</option>

                        </select>
                    </div>

                    <br>
                    <div class="remember-checkbox mb-20">
                        <input type="checkbox"  class="my_checkbox" name="state_of_section" value="1" id="20" required>
                        <label class="form-check-label" for="20">الحالة الخاصة بالقسم </label></div>

                    <br>



                    <button type="submit" class="btn btn-secondary">ارسل</button>

                </form>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('https://code.jquery.com/jquery-3.6.3.min.js')}}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
        function get_sections(id) {
            console.log(id);
            if(id>0){
            $.ajax({
                type:'get',
                url:'{{route('get_class')}}',
                data:{
                    '_token':'{{csrf_token()}}',
                    'id':id,
                },
                success:function (data){
                    if(data.state==true){
                        console.log( data.items);
                       var list_class=document.getElementById("result_grade");
                       list_class.innerHTML=null;
                        data.items.forEach(element =>list_class.innerHTML=list_class.innerHTML+"<option value="+element[0]+">" + element[1] + '</option>');

                    }

                }
            });}
        }
    </script>
@endsection
@section('js')

@endsection
