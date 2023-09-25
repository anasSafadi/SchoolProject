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
                <h4 class="mb-0"> ALL ZOOM</h4>
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
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">

                        @foreach($sub as $x=>$material)
                            <u><h5> - {{$material->material->name}} {{$class=$material->class_room_of_material->name_class}} {{$material->class_room_of_material->grade->name}}</h5></u>
                                <table id="datatable" class="table table-hover table- table-bordered p-0" data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان المحاضرة</th>
                                        <th>الاقسام</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    @foreach($material->lectures as $lecture)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$lecture->title}}</td>
                                            <td>
                                                @foreach($lecture->all_sections as $section)
                                                    {{$class}}-{{$section->name_section}}<br>
                                                    @endforeach

                                            </td>
                                            <td>
                                                <a href="{{route('edit_view_lecturer',$lecture->id)}}">edit</a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#delete_{{$lecture->id}}"><i  class="fa fa-trash"></i></button>
                                                <div class="modal fade" id="delete_{{$lecture->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="exampleModalLabel">are you shore !!</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {{$lecture->title}}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <form action="{{route("delete_lecturer",$lecture->id)}}" method="get"><button type="submit" class="btn btn-danger">yes</button></form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#delete">اسماء الطلاب الحاضرين</button>
                                            </td>
                                        </tr>
                                    @endforeach



                                </table>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
