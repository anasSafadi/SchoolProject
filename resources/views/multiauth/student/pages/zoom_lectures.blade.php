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
                <u><h4 class="mb-10 mt-20"> ALL ZOOM</h4></u>
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
                            <tr style="background: #bebbbb">
                                <th>#</th>
                                <th>عنوان المحاضرة</th>
                                <th>موعد المحاضرة</th>
                                <th>URL</th>
                                <th>المادة</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($my_lectures_zoom as $x=>$item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->topic}}</td>
                                    <td>{{ date('Y-d-m/h:i', strtotime($item->start_at) ) }}</td>
                                    <td><u><a href="{{$item->join_url}}" style="font-size: 15px;color: #ff070e">انضم الان</a></u></td>
                                    <td>{{$item->zoom_sub_material->material->name}}</td>


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
