@extends('layouts.master')
@section('css')
    <link href="{{asset('/filepond/filepond.css')}}" rel="stylesheet" />
@section('title')

@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.add_student')}}
@stop
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
        option{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;}
        h6{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 18px;}


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

                    <form method="post"  action="">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{$worlds["add_student"]}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["name_student"]}}(AR) : <span class="text-danger">*</span></label>
                                    <input  type="text" id="name_ar"  class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["name_student"]}}(EN) : <span class="text-danger">*</span></label>
                                    <input  class="form-control" id="name_en" type="text" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["email"]}} : </label>
                                    <input type="email"  id="email" class="form-control" >
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{$worlds["password"]}} :</label>
                                    <input  type="password" id="password" class="form-control" >
                                </div>
                            </div>



                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nal_id" id="area">{{$worlds["area"]}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="nationalitie_id">
                                        <option selected disabled>Choose...</option>
                                        @foreach($data["areas"] as  $area)
                                            <option value="{{$area->id}}">{{$area->name_area}}</option>

                                            @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{$worlds["date_student"]}}  :</label>
                                    <input class="form-control" type="date"  id="Date_Birth" />
                                </div>
                            </div>

                        </div>

                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">معلومات الصف الدراسي</h6><br>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{$worlds["name_grade"]}} : <span class="text-danger">*</span></label>
    /**1**/                                <select class="custom-select mr-sm-2" id="grade_id" onclick="get_class($(this).val())">
                                        <option selected disabled>Choose....</option>
                                        @foreach($data["grades"] as $grade)
                                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{$worlds["name_class"]}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" id="classroom_id" onclick="get_sections($(this).val())">

                                        <option selected disabled>Choose....</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{$worlds["name_section"]}} : </label>
                                    <select class="custom-select mr-sm-2" id="section_id">
                                        <option selected disabled>Choose....</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="parent_id">{{$worlds["father"]}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" id="parent_id">
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($data["parents"] as $parent)
                                            <option value="{{$parent->id}}">{{$parent->name_father}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                        </div><br>
                        <fieldset>
                            <legend>Files</legend>

                            <!-- a list of already uploaded files -->
                            <ol>

                            </ol>

                            <!-- our filepond input -->

                            <input type="file"  name="avatar"  required multiple />
                        </fieldset>
                        <hr>
                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" id="save_data" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">تسجيل الطالب</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('https://code.jquery.com/jquery-3.6.3.min.js')}}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="{{asset('/filepond/filepond.js')}}"></script>
    <!-- row closed -->

@endsection
@section('js')
    <script>
        let description=[];
        let urls=[];
        let files=[];
        const fieldsetElement = document.querySelector('fieldset');
        const pond2 = FilePond.create(fieldsetElement);
        console.log(pond2.files);
        const inputElement = document.querySelector('input[id="avatar"]');
        const pond = FilePond.create(inputElement);
        FilePond.setOptions({
            server: {
                url: '/student/upload_files',
                timeout: false,
                process: {
                    headers: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}',
                    },
                    withCredentials: false,
                    onload: (response) => {files.push(response);console.log(files);},
                    onerror: (response) => console.log("404"),

                },
                // revert: './revert',
                // restore: './restore/',
                // load: './load/',
                // fetch: './fetch/',
            },});
        $(document).on("click","#save_data",function (e) {
            e.preventDefault();
            let send_btn_lecture=document.getElementById('save_data');
              send_btn_lecture.disable=true;
               send_btn_lecture.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">loading..</span>' ;

            $.ajax({

                url: '{{route('student.register.store')}}',
                type: 'post',
                data: {
                    '_token':"{{csrf_token()}}",
                    'name_ar': document.getElementById("name_ar").value,
                    'name_en': document.getElementById("name_en").value,
                    'email': document.getElementById("email").value,
                    'password': document.getElementById("password").value,
                    'area': document.getElementById("area").value,
                    'grade_id': document.getElementById("grade_id").value,
                    'classroom_id': document.getElementById("classroom_id").value,
                    'section_id': document.getElementById("section_id").value,
                    "parent_id":document.getElementById("parent_id").value,
                    "Date_Birth":document.getElementById("Date_Birth").value,
                    "files":files
                },
                success: function (data) {
                    if(data.state==true){
                        // send_btn_lecture.disabled=false;
                        // send_btn_lecture.innerHTML="send";
                        window.location.href="{{route("add_students")}}";

                    }
                },
                error:function (data){
                    // send_btn_lecture.disabled=true;
                    // send_btn_lecture.innerHTML="send";
                },


            });
        });

    </script>


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
                            var list_class=document.getElementById("classroom_id");
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
                            var list_class=document.getElementById("section_id");
                            list_class.innerHTML="<option selected disabled>Choose....</option>";
                            data.items.forEach(element =>list_class.innerHTML=list_class.innerHTML+"<option value="+element[0]+">" + element[1] + '</option>');

                        }

                    }
                });}
        }
    </script>
@endsection
