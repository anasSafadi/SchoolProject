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
                <h4 class="mb-0">جميع المراحل الدراسية</h4>
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


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">

                        اضافة مرحلة دراسية جديدة
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{route("add_grade")}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Name" class="mr-sm-2">اسم المرحلة AR</label>
                                <input id="Name" type="text" name="name_ar" class="form-control">
                            </div>
                            <div class="col">
                                <label for="Name_en" class="mr-sm-2">اسم المرحلة EN</label>
                                <input type="text" class="form-control" name="name_en">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">ملاحظات
                                :</label>
                            <textarea class="form-control" name="note" id="exampleFormControlTextarea1"
                                      rows="3"></textarea>
                        </div>
                        <br><br>
                        <button type="submit"class="btn btn-secondary">ارسل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">
                        اضافة مرحلة دراسية جديدة

                    </button>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Note</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($Grade as $item)
                            <tr>
                                <td style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">{{$loop->iteration}}</td>
                                <td style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;"> {{$item->name}}</td>
                                <td style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">{{$item->note}}</td>

                                <td ><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_{{$item->id}}"><i class="fa fa-trash"></i></button>
                                    <div class="modal fade" id="delete_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="exampleModalLabel">are you shore !!</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    delete_{{$item->id}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <form action="{{route("delete_grade",$item->id)}}" method="get"><button type="submit" class="btn btn-danger">yes</button></form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_{{$item->id}}"><i class="fa fa-edit"></i></button>

{{--                          _______________________________________________________________________________          /**edite**/--}}
                                    <div class="modal fade" id="edit_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                        {{ trans('Grades_trans.add_Grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <!-- add_form -->
                                                    <form action="{{route("edit_grade",$item->id)}}" method="get">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Name" class="mr-sm-2">الاسم القديم AR</label>
                                                                <input value="{{$item->getTranslation("name","ar")}}" type="text" name="name_ar" class="form-control">
                                                            </div>
                                                            <div class="col">
                                                                <label for="Name" class="mr-sm-2">الاسم القديم EN</label>
                                                                <input value="{{$item->getTranslation("name","en")}}" type="text" class="form-control" name="name_en">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">ملاحظات
                                                                :</label>
                                                            <input class="form-control" value="{{$item->note}}" name="note" >
                                                        </div>
                                                        <br><br>
                                                        <button type="submit"class="btn btn-secondary">تعديل</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--                          _______________________________________________________________________________          /**edite**/--}}

                                </td>


                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
{{--                            <tr>--}}
{{--                                <th>Name</th>--}}
{{--                                <th>Position</th>--}}
{{--                                <th>Office</th>--}}
{{--                                <th>Age</th>--}}
{{--                                <th>Start date</th>--}}
{{--                                <th>Salary</th>--}}
{{--                            </tr>--}}
                            </tfoot>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->


@endsection
@section('js')

@endsection
