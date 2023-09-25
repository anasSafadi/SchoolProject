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
                <h4 class="mb-0 text-danger">MAKE NEW EXAMS FOR STUDENT</h4>
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
        label {  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;}
        option {  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;}
    </style>
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Grade_id">المرحلة الدراسية: <span class="text-danger">*</span></label>
                                /**1**/                                <select class="custom-select mr-sm-2" id="grade_id" onclick="get_class($(this).val())">
                                    <option selected disabled>Choose....</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Classroom_id">الصف الدراسي : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="classroom_id" onclick="get_sections_and_sub($(this).val())">

                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <hr/>
                                <label for="section_id">المادة : </label>
                                <select class="custom-select mr-sm-2" id="sub_id">
                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div>

                        {{--                        <div class="col-md-6">--}}
                        {{--                            <div class="form-group">--}}
                        {{--                                <label for="section_id">القسم : </label>--}}
                        {{--                                <select class="custom-select mr-sm-2" id="section_id" onclick="get_student_by_section($(this).val())">--}}
                        {{--                                    <option selected disabled>Choose....</option>--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                    </div>




                    <br>

                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-0">الاقسام التي سوف تدخل في الاختبار</h4>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row" id ="sections_exam">
                                   الرجاء اختيار صف دراسي مناسب

                                </div>

                                <button class="btn btn-danger" id="send_data_btn" onclick="send_data()">ارسل</button>
                            </div></div>
                    </div></div></div></div></div>


    <!-- row closed -->
    <script>
        let id_of_sub_m=null;
        let id_of_section=null;
        function get_class(id) {
            console.log(id);
            if(id>0){
                $.ajax({
                    type:'post',
                    url:'{{route('get_class_for_teacher')}}',
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
        function get_sections_and_sub(id) {
            console.log(id);
            if(id>0){
                $.ajax({
                    type:'post',
                    url:'{{route('get_sub_by_class_id')}}',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id_of_class':id,
                    },
                    success:function (data){
                        if(data.state==true){

                            var section_exam=document.getElementById("sections_exam");
                            section_exam.innerHTML=null;
                            for(var i=0;i<data.sections.length;i++){
                                var check_box=document.createElement("input");
                                check_box.setAttribute("value",data.sections[i][0]);
                                check_box.setAttribute("type","checkbox");
                                check_box.setAttribute("class","sections_for_exam");
                                check_box.setAttribute("id",`section_${data.sections[i][0]}`);
                                check_box.setAttribute("style","margin:10px");


                                var lable=document.createElement("label");
                                lable.innerText="قسم فرع -  "+data.sections[i][1];
                                lable.setAttribute("for",`section_${data.sections[i][0]}`);

                                var div=document.createElement("div");
                                div.className="col-xl";
                                div.setAttribute('style','font-weight: bold;font-family:\'Simplified Arabic\'; font-size: 14px;')

                                div.appendChild(check_box);
                                div.appendChild(lable);


                                section_exam.appendChild(div);


                            }



                            var list_sub=document.getElementById("sub_id");
                            list_sub.innerHTML="<option selected disabled>Choose....</option>";
                            data.sub_materials.forEach(element =>list_sub.innerHTML=list_sub.innerHTML+"<option value="+element[0]+">" + element[1] + '</option>');

                        }

                    }
                });}
        }

        function send_data() {
            sections_ids=[];
            let send_data_btn=document.getElementById('send_data_btn');
            var sections=document.getElementsByClassName('sections_for_exam');

            for(var i=0;i<sections.length;i++){
                if(sections[i].checked==true){
                    sections_ids.push(sections[i].value);
                }
            }


            $.ajax({

                url: '{{route("store_exam")}}',
                type: 'post',
                data: {
                    '_token':"{{csrf_token()}}",
                    'sub_id': document.getElementById('sub_id').value,
                    'sections_ids': sections_ids,
                    "grade_id":document.getElementById('grade_id').value,

                },
                success: function (data) {
                    if(data.state==true){
                        send_data_btn.className="btn btn-success"
                        send_data_btn.innerHTML="تم الارسال بنجاح";
                        location. reload()
                    }
                    if(data.state==false){
                        send_data_btn.disabled=false;
                        send_data_btn.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
                    }
                },
                error:function (data){
                    if(data.state==false){
                        send_data_btn.disabled=false;
                        send_data_btn.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
                    }

                },






                {{--});--}}
            });}

    </script>
@endsection
@section('js')


@endsection
