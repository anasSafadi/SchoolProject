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
                        <table id="datatable" class="table table-hover table- table-bordered p-0" data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان المحاضرة</th>
                                <th>موعد المحاضرة</th>
                                <th>URL</th>
                                <th>المادة</th>
                                <th>الصف</th>
                                <th>الاقسام التي سوف تنضم</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($zoom as $x=>$item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->topic}}</td>
                                    <td>{{$item->start_at}}</td>
                                    <td><u><a href="{{$item->join_url}}" style="font-size: 15px;color: #ff070e">انضم الان</a></u></td>
                                    <td>{{$item->zoom_sub_material->material->name}}</td>
                                    <td>
                                        {{$class=$item->zoom_sub_material->class_room_of_material->name_class}}-{{$item->zoom_sub_material->class_room_of_material->grade->name}}

                                    </td>
                                    <td>
                                        @foreach($item->all_sections as $section)
                                           {{$class}}-{{$section->name_section}}
                                            @endforeach
                                    </td>

                                </tr>
                            @endforeach


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
