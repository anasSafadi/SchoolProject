@extends('layouts.master')
@section('css')

@section('title')
    show-all-teachers
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->

    <style>
        td{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } button{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}

    </style>
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> show-all-teachers</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">Page Title</li>
                </ol>
            </div>
        </div>
    </div>


    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="create_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label>عنوان الرسالة</label>
                   <input class="form-control" name="title_msg" id="title_msg"/>
                    <label>نص الرسالة</label>
                    <textarea name="text_area_msg" id="text_area_msg" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="row" style="padding: 20px">


                    <div class="remember-checkbox mb-20 col">
                        <input  type="checkbox" id="WEB_MSG" name="WEB_MSG" value="100">
                        <label class="form-check-label" for="WEB_MSG">
                            WEB MSG</label></div>

                    <div class="remember-checkbox mb-20 col">
                        <input  type="checkbox" id="Gmail_MSG" value="200" >
                        <label class="form-check-label" for="Gmail_MSG">
                            Gmail MSG</label></div>


                    <div class="remember-checkbox mb-20 col">
                        <input  type="checkbox" id="SMS_MSG" name="" value="300">
                        <label class="form-check-label" for="SMS_MSG">
                            SMS MSG</label></div>



                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-danger mr-10" data-dismiss="modal">اغلاق</button>
                    <button type="button" class="btn btn-primary" id="send_the_msg">ارسال</button>
                </div>
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
                    <div class="table-responsive">
                        <button class="btn btn-danger mb-10" id="msg_btn" data-toggle="modal" data-target="#create_msg">MSG</button>


                        <table id="datatable" class="table table-hover table- table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>
                                    <div class="remember-checkbox mb-20">
                                        <input class="parent_checkbox" type="checkbox" id="parent_checkbox" onclick="select_all()">
                                        <label class="form-check-label" for="parent_checkbox">
                                            الكل</label></div> </th>
                                <th>#</th>
                                <th>اسم المعلم</th>
                                <th>المواد الدراسية التي يدرسها المهعلم</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $class_teacher=[];?>

                            @foreach($teachers as $x=>$item)
                                <tr id="row_{{$item->id}}">
                                    <td><div class="remember-checkbox mb-20"><input type="checkbox"  class="my_checkbox" value="{{$item->id}}" id="{{$item->id}}" onclick="single_select({{$item->id}})"/>
                                            <label class="form-check-label" for="{{$item->id}}">-</label>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name}}<br>
                                    {{$item->email}}</td>
{{--                                    <td> @foreach($item->sub_materials as $x2=>$sub)--}}
{{--                                           <?php  $exist= $sub->class_room_of_material->name_class." ".$sub->class_room_of_material->grade->name;--}}

{{--                                            $class_teacher[$x2]=$exist;--}}
{{--                                               if (array_search($exist,$class_teacher)){--}}
{{--                                               echo $exist;--}}
{{--                                               } ?>--}}
{{--                                        @endforeach</td>--}}
                                    <td>

                                        @if($item->sub_materials->count()==0)
                                            لا يدرس اي مادة
                                            @else
                                       @foreach($item->sub_materials as $sub)
                                    <?php  echo  $ex=$sub->material->name ." ".$sub->class_room_of_material->name_class." ".$sub->class_room_of_material->grade->name?>
                                           <br>

                                           @endforeach
                                    @endif
                                </tr>
                            @endforeach

                            <!-- edit_modal_Grade -->


                            <!-- delete_modal_Grade -->


                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    <!-- row closed -->
@endsection
@section('js')
    <script>
        ids_of_teachers=[];
    var msg_btn=document.getElementById("msg_btn");
    msg_btn.disabled=true;

    var ids_of_teachers=[];
    function select_all() {
        msg_btn.disabled=false;
    var inputs=document.getElementsByClassName("my_checkbox");
    var parent_checkbox=document.getElementById("parent_checkbox");
    if(parent_checkbox.checked == true){

    for (var i = 0; i < inputs.length; i++) {
    inputs[i].checked = true;
    ids_of_teachers.push(inputs[i].value)
    }
    console.log(ids_of_teachers);
    }
    if(parent_checkbox.checked==false){
        msg_btn.disabled=true;
    for (var i = 0; i < inputs.length; i++) {
        ids_of_teachers.splice(inputs[i], 1);
    inputs[i].checked = false;}}}
    /*222222222222222222222222222222222222222222*/
    function single_select(id) {

    var parent_checkbox=document.getElementById(id);

    if(parent_checkbox.checked == true){
        msg_btn.disabled=false;
        ids_of_teachers.push(parent_checkbox.value);
    console.log(ids_of_teachers);
    }
    if(parent_checkbox.checked==false){

    if(ids_of_teachers.length==1){
        msg_btn.disabled=true;
    document.getElementById("parent_checkbox").checked=false;
    };
    const index = ids_of_teachers.indexOf(id.toString());
    ids_of_teachers.splice(index, 1);
    //delete arr[index];
    console.log(ids_of_teachers);
    }}
    /*333333333333333333333333333333333333333333333333333*/



    $(document).on("click","#send_the_msg",function (e){
        broker=[];
        let send_the_msg=document.getElementById('send_the_msg');
        //send_the_msg.disabled=true;
        send_the_msg.innerText="Processing..";
        title_msg=document.getElementById('title_msg').value;
        content_msg=document.getElementById('text_area_msg').value;

      if(document.getElementById('SMS_MSG').checked==true){
          broker.push(document.getElementById('SMS_MSG').value)
        }
        if(document.getElementById('Gmail_MSG').checked==true){
            broker.push(document.getElementById('Gmail_MSG').value)
        }
        if(document.getElementById('WEB_MSG').checked==true){
            broker.push(document.getElementById('WEB_MSG').value)
        }
        e.preventDefault();
        $.ajax({
            type:'post',
            url:'{{route('send_msg_from_admin_to_teachers')}}',
            data:{
                '_token':'{{csrf_token()}}',
                'broker':broker,
                'title_msg':title_msg,
                'content_msg':content_msg,
                'ids_of_teachers':ids_of_teachers,
            },
            success:function (data){
                if(data.state==true){
                    send_the_msg.className="btn btn-success";
                    send_the_msg.innerText="success";
                    location.reload();}
                    if(data.state==false){
                        send_the_msg.className="btn btn-info";
                        send_the_msg.disabled=false;
                        send_the_msg.innerText=data.msg;
                       }

            },
            error:function(data){
                if(data.state==false){
                    send_the_msg.className="btn btn-info";
                    send_the_msg.disable=false;
                    send_the_msg.innerText=data.msg;
                }

            },
        });
    });
    </script>

@endsection
