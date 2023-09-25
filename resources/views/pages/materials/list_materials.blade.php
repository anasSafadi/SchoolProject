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
                <h4 class="mb-0"> قائمة المواد الدرساية الموجودة</h4>
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
        td{
            font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        } button{ font-weight: bold;font-family:'Simplified Arabic'; font-size: 16px;}

    </style>
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    @foreach($grades as $grade)

                        <u><h1> مواد مرحلة {{$grade->name}}</h1></u>

                        @foreach($grade->all_class_rooms as $class)

                            <h6>{{$class->name_class}} - {{$grade->name}}</h6>
                    <div class="table-responsive">
                        <table id="datatable" class="table-bordered border table table-striped dataTable p-0">
                            <thead>
                            <tr>
                                <th>اسم المادة</th>
                                <th>المعلم</th>
{{--                                <th>االاقسام</th>--}}

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($class->sub_material as $sub_material)
                                <tr>
                                    <td> {{$sub_material->material->name}} </td>
{{--                                    {{$class->name_class}} {{$grade->name}}--}}
                                    <td>
                                        {{$sub_material->teacher->name}}


                                    </td>


{{--                                    <td>--}}
{{--                                        @foreach($class->all_sections)--}}
{{--                                            @endforeach--}}
{{--                                    </td>--}}

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                            @endforeach
                        <hr/>
                        @endforeach


                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
