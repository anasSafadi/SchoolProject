@extends('layouts.master')
@section('css')

@section('title')
    اضافة سؤال جديد
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    اضافة سؤال جديد
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <style>
        label {font-family: "Simplified Arabic";font-weight: bold;font-size: 18px}

    </style>
    <?php $m=$exam->sub_material?>
    <h1 style="margin-top:15px;margin-bottom: 10px ">اختبار مادة   {{$m->material->name}}({{$m->class_room_of_material->name_class}}-{{$m->class_room_of_material->grade->name}})</h1>
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">

                        <div class="col-xl"> <a class="btn btn-danger" href="{{route('show_questions',$exam->id)}}" >اظهار الاسئلة</a></div>
                        <div class="col-xl"> <a class="btn btn-info" href="{{route('get_all_exams')}}" > جميع الاختبارات</a></div>
                        <div class="col-xl"></div>
                        <div class="col-xl"> عدد الاسئلة: <h6 id="count_q">  {{$exam->questions->count()}}</h6></div>

                    </div>
                </div>
            </div></div></div>

    <!-- row -->

    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>




                                <div class="form-row">


                                    <div class="col">
                                        <label for="title">اسم السؤال</label>
                                        <input type="text" name="title" id="question"
                                               class="form-control form-control-alternative" autofocus>
                                    </div>
                                </div>
                                <hr>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">الاجابات</label>
                                        <textarea name="answers" class="form-control" id="options"
                                                  rows="4"></textarea>
                                    </div>
                                </div>
                                <br>



                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" id="send_data" onclick="save_data()">حفظ البيانات</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function save_data() {
            all_options=[];
            var send_data_btn=document.getElementById('send_data');
            var question=document.getElementById('question');
            var options=document.getElementById('options');
            if(question.value!=""&&options.value!=""){



            text_options=options.value;
            array_options=text_options.split(" ");


            for(var i=0;i<array_options.length;i++){
                if(array_options[i].length>0){
                    all_options.push(array_options[i]);
                }
            }

                send_data_btn.disabled=true;
                $.ajax({

                    url: '{{route("store_question")}}',
                    type: 'post',
                    data: {
                        '_token':"{{csrf_token()}}",
                        'question': question.value,
                        'options': all_options,
                        "exam_id":'{{$exam->id}}',

                    },
                    success: function (data) {
                        if(data.state==true){
                            send_data_btn.className="btn btn-success";
                            send_data_btn.disabled=false;
                            send_data_btn.innerHTML="تم الارسال بنجاح";
                            all_options=null;
                            question.value=""
                            options.value=""
                            $count_q=document.getElementById('count_q').innerText;
                            $last=Number($count_q);
                            document.getElementById('count_q').innerText=$last+1;


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

                });



            console.log(all_options);

        }
        }
    </script>
    <!-- row closed -->
@endsection
@section('js')

@endsection
