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
                <h4 class="mb-0"> ncvlxcnvxcnvxcv</h4>
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
                    <table id="datatable" class="table table-hover table- table-bordered p-0" data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الحالة</th>
                            <th>الملفات الخاصة بالطالب</th>

                        </tr>
                        </thead>
                        <tbody>


                        @foreach($home_work->assignment_delivery as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->student->name}}</td>
                                <td>@if($item->active=="1") <i class="fa fa-circle text-success"></i>
                                    @else<i class="fa fa-circle text-danger"></i>
                                    @endif</td>
                                <td>
                                    <ul>
                                   @foreach($item->files as $file)
                                       <li>
                                      <a href="{{route('download_files_for_teacher',$file->url)}}">{{$file->client_name}}</a>
                                       </li>
                                       @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
