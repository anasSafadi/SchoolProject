@extends('layouts.master')
@section('css')

@section('title')

@stop
@endsection
@section('page-header')

    <link href="{{asset('/filepond/filepond.css')}}" rel="stylesheet" />
    <script src="{{asset('https://code.jquery.com/jquery-3.6.3.min.js')}}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="{{asset('/filepond/filepond.js')}}"></script>
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> ادراج واجب منزلي</h4>
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
    <button id="send_data" class="btn btn-danger" style="margin-bottom: 10px">Save</button>

    <div class="card card-statistics mb-30">

        <div class="card-body datepicker-form">
            <h5 class="card-title">اخر موعد للتسليم</h5>

            <div class="form-group">
                <div class='input-group date' id='datepicker-action'>
                    <input class="form-control" type='text' value="290/07/2018" id="end_date"/>
                    <span class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </span>
                </div>
                <p class="mt-2"> سيتم اغلاق القدرة على التسلم بعد هذا التاريخ </p>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="row"style="margin-bottom: 20px">
                        <div class="col">
                            <span>العنوان</span>
                            <input type="text" class="form-control" id="title"/>
                        </div>
                        <div class="col">
                            <span>شرح</span>
                            <input type="text" class="form-control" id="description"/>
                        </div>
                    </div>

                    <div class="row">
                       @foreach($sections as $section)
                            <div class="col"><div class="remember-checkbox mb-20 col"><input type="checkbox"  checked class="my_checkbox" value="{{$section->id}}" id="for_{{$section->id}}"/>
                                    <label class="form-check-label" for="for_{{$section->id}}">{{$section->class_room_of_section->name_class}}-{{$section->name_section}}</label></div></div>
                           @endforeach
                    </div>
                    <fieldset>
                        <legend>Files</legend>

                        <!-- a list of already uploaded files -->
                        <ol>

                        </ol>

                        <!-- our filepond input -->

                        <input type="file"  name="avatar"  required multiple />
                    </fieldset>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    <script>

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
            },});



        /**send the data**/
        $(document).on("click","#send_data",function (e) {
            e.preventDefault();
            let all_sections=document.getElementsByClassName("my_checkbox");
            let all_sections_ids=[];
            for (var i = 0; i < all_sections.length;i++) {
                if(all_sections[i].value>0 && all_sections[i].checked == true){

                    all_sections_ids.push(all_sections[i].value);}
            }


            console.log(all_sections_ids);
            let send_btn_lecture=document.getElementById('send_data');
            //send_btn_lecture.disabled=true;
            send_btn_lecture.innerHTML='LOADING..';
            $.ajax({

                url: '{{route("store_homework")}}',
                type: 'post',
                data: {
                    '_token':"{{csrf_token()}}",
                    'title': document.getElementById("title").value,
                    'description': document.getElementById("description").value,
                    "end_date": document.getElementById("end_date").value,
                    'files_path':files,
                    'sub_material_id':"{{$id_material}}",
                    "all_sections_ids":all_sections_ids,
                },
                success: function (data) {
                    if(data.state==true){
                        send_btn_lecture.className="btn btn-success"
                        send_btn_lecture.innerHTML="تم الارسال بنجاح";
                        location. reload()
                    }
                    if(data.state==false){
                        send_btn_lecture.disabled=false;
                        send_btn_lecture.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
                    }
                },
                error:function (data){
                    if(data.state==false){
                        send_btn_lecture.disabled=false;
                        send_btn_lecture.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
                    }

                },


            });
        });




    </script>

@endsection
