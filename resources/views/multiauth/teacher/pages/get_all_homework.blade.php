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


                        @foreach($materials as $x=>$material)
                            @if($material->home_works->count()>0)
                            <u><h5> - {{$material->material->name}} {{$class=$material->class_room_of_material->name_class}} {{$material->class_room_of_material->grade->name}}</h5></u>
                            <table id="datatable" class="table table-hover table- table-bordered p-0" data-page-length="50"
                                   style="text-align: center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>العنوان</th>

                                    <th>عدد المسلمين</th>
                                    <th>الاقسام الخاصة بالنشاط</th>
                                    <th>ملاحظات</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($material->home_works as $home_work)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$home_work->title}}</td>
                                        <td>{{$home_work->assignment_delivery->count()}}/{{$home_work->assignment_delivery->where("active","1")->count()}}</td>
                                        <td>
                                            @foreach($home_work->sections as $section)
                                                {{$class}}-{{$section->name_section}}<br>
                                            @endforeach

                                        </td>
                                        <td>

                                            <a href="{{route('show_student_of_home_work',$home_work->id)}}" class="btn btn-success btn-sm" ><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach



                            </table>
                            <hr/>
                            @endif
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
