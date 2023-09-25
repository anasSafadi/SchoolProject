@extends('layouts.master')
@section('css')


@section('title')
@stop
@endsection
@section('page-header')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <style>
        td{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } button{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}
        h4{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 20px;}
        label{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 18px;}

    </style>
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <br><br>

                <h4 class="mb-0"> معلومات الصفوف الدراسية</h4>
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
                $worlds=["add_class"=>"اضافة صف جديد","name_class"=>"اسماء الصفوف","grade_class"=>"المرحلة الدراسية","actions"=>"ملاحظات","add"=>"اضافة","delete"=>"حذف"];
        }
        else{

            $worlds=["add_class"=>"Add Class","name_class"=>"Name of Class","grade_class"=>"Grade of Class","actions"=>"TEST","add"=>"ADD","delete"=>"Delete"];
        }

    @endphp
    <div class="row">

        <div class="col-xl-12 mb-30">
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


                    <button type="button" class="button x-small btn-primary" data-toggle="modal" data-target="#exampleModal">
                        {{ $worlds['add_class']}}
                    </button>
                        <button class="btn btn-danger" style="margin: 10px" id="delete_items">delete the selection</button>
                    <br><br>

                    <div class="table-responsive">

                        <table id="datatable" class="table table-hover table- table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr style="background: #dbdbdb">
                                <th>
                                    <div class="remember-checkbox mb-20">
                                        <input class="parent_checkbox" type="checkbox" id="parent_checkbox" onclick="select_all()">
                                        <label class="form-check-label" for="parent_checkbox">
                                            الكل</label></div> </th>
                                <th>#</th>
                                <th>{{ $worlds['name_class']}}</th>
                                <th>{{ $worlds['grade_class']}}</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($classrooms as $x=>$item)
                                <tr id="row_{{$item->id}}">
                                    <td><div class="remember-checkbox mb-20"><input type="checkbox"  class="my_checkbox" value="{{$item->id}}" id="{{$item->id}}" onclick="single_select({{$item->id}})"/>
                                        <label class="form-check-label" for="{{$item->id}}">-</label>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->name_class}}</td>
                                    <td>{{$item->grade->name}}</td>

                                </tr>
                                @endforeach

                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('Grades_trans.edit_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="Name"
                                                                   class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                                                :</label>
                                                            <input id="Name" type="text" name="Name"
                                                                   class="form-control"
                                                                   value=""
                                                                   required>
                                                            <input id="id" type="hidden" name="id" class="form-control"
                                                                   value="">
                                                        </div>
                                                        <div class="col">
                                                            <label for="Name_en"
                                                                   class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                   value=""
                                                                   name="Name_en" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                                            :</label>
                                                        <textarea class="form-control" name="Notes"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="3"></textarea>
                                                    </div>
                                                    <br><br>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ trans('Grades_trans.delete_Grade') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ trans('Grades_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id" class="form-control"
                                                           value="">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title">
                           الاسم (EN)
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form class="row mb-30" action="{{route('add_class')}}" method="POST">
                            @csrf

                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Classes">
                                        <div data-repeater-item>

                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">الاسم (ar):</label>
                                                    <input class="form-control" type="text" name="name_class_ar" required />
                                                </div>

                                                <div class="col">
                                                    <label for="Name"
                                                           class="mr-sm-2">الاسم (EN):</label>
                                                    <input class="form-control" type="text" name="name_class_en" required />
                                                </div>


                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">المرحلة (ar):</label>


                                                    <div class="box">
                                                        <select class="form-select form-select-lg mb-3" aria-label="Default select example" name="grade_id">
                                                            <option selected>Open this select menu</option>
                                                            @foreach($Grade as $item)
                                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="Name_en"
                                                           class="mr-sm-2">حذف الصف :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                           type="button" value="{{$worlds['delete']}}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="ادراج صف جديد"  style="font-weight: bold;font-size: 14px"/>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">ESC</button>
                                        <button type="submit"
                                                class="btn btn-success">GO</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div></div></div></div></div>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <script>

        var btn_delete_btn=document.getElementById("delete_items");
        btn_delete_btn.disabled=true;

        var arr=[];
        function select_all() {
            btn_delete_btn.disabled=false;
            var inputs=document.getElementsByClassName("my_checkbox");
            var parent_checkbox=document.getElementById("parent_checkbox");
            if(parent_checkbox.checked == true){
                arr=[];
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].checked = true;
                    arr.push(inputs[i].value)
                }
                console.log(arr);
            }
            if(parent_checkbox.checked==false){
                btn_delete_btn.disabled=true;
                for (var i = 0; i < inputs.length; i++) {
                    arr.splice(inputs[i], 1);
                    inputs[i].checked = false;}}}
        /*222222222222222222222222222222222222222222*/
        function single_select(id) {

            var parent_checkbox=document.getElementById(id);

            if(parent_checkbox.checked == true){
                btn_delete_btn.disabled=false;
                arr.push(parent_checkbox.value);
                console.log(arr);
            }
            if(parent_checkbox.checked==false){

                if(arr.length==1){
                    btn_delete_btn.disabled=true;
                    document.getElementById("parent_checkbox").checked=false;
                };
                const index = arr.indexOf(id.toString());
                arr.splice(index, 1);
               //delete arr[index];
                console.log(arr);
                }}
                /*333333333333333333333333333333333333333333333333333*/


            $(document).on("click","#delete_items",function (e){
                e.preventDefault();

                $.ajax({
                    type:'post',
                    url:'{{route('class.rooms.destroy')}}',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'items':arr,
                    },
                    success:function (data){
                        if(data.state==true){
                            btn_delete_btn.disabled=true;
                            // $('#row_'+data.items[0]).remove();
                            data.items.forEach(element => $('#row_'+element).remove());

                        }
                        else if(data.state==false){
                            window.alert("Delete Reject");
                        }else {
                            console.log('89');

                        }

                    }
                });
            });

    </script>

    <!-- row closed -->
@endsection

@section('js')

@endsection
