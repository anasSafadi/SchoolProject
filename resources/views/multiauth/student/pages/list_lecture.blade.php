@extends('layouts.master')
@section('css')

@section('title')

@stop
@endsection
@section('page-header')
    <br>
    <div class="card o-visible" style="padding: 10px;border-radius: 10px" ><center><h4 class="mb-0" style="font-family: 'Simplified Arabic';font-weight: bold;"> مادة {{$material->material->name}} -  مدرس المساق (  {{$material->teacher->name}}) </h4></center> </div>


    <br>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->



                <div class="row">

        @foreach($my_lectures as $lecture)
                        <div class="col-xl-6" >
                            <div class="card o-visible" style="min-height: 450px ;max-height: 450px ;padding: 20px;margin-bottom:50px " >
                                <div class="card-header" style="background: rgb(40,42,57);border-radius: 15px">
                                    <h5 style="font-family: 'Simplified Arabic';font-weight: bold;color: white;" >محاضرة رقم -  {{$loop->iteration}}</h5>
                                </div>
                                <div class="card-block" style="padding: 10px">
                                    <h6>{{$lecture->created_at->format("y-m-d")}}</h6>
                                    <center><h6 style="font-family: 'Simplified Arabic';font-weight: bold">{{$lecture->title?:"NO DESCRIPTION"}}</h6></center>
                                    <p style="font-size: 15px;font-family: 'Simplified Arabic';font-weight: bold" >
                                        {{$lecture->description?:"NO DESCRIPTION"}}
                                    </p>
                                    <hr/>

                                    <div class="row">
                                        <div class="col-6">

                                            <u> <h5 style="font-family: 'Simplified Arabic';font-weight: bold" >ملفات تم ادراجها مع المحاضرة</h5></u><br>
                                            @if(isset($lecture->files)&&$lecture->files->count()>0)
                                                <ol>


                                                    @foreach($lecture->files as $file)

                                                        <li>
                                                          <a href="{{route('download_file',$file->url)}}"><u>{{$file->client_name}}</u></a>


                                                        </li>

                                                    @endforeach
                                                </ol>
                                            @else
                                                <div class="alert alert-danger" style="width: 50%" >لايوجد ملفات لهذه المحاضرة</div>
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <u> <h5 style="font-family: 'Simplified Arabic';font-weight: bold">روابط خارجية</h5></u><br>
                                            @if(isset($lecture->urls)&&$lecture->urls->count()>0)
                                                <ol>

                                                    @foreach($lecture->urls as $url)
                                                        <li>

                                                         <a class="btn btn-link"  href="{{$url->url}}"> {{$url->description}}</a><i class="fa fa-link"></i>
                                                        </li>

                                                    @endforeach
                                                </ol>
                                            @else
                                                <div class="alert alert-info" style="width: 50%" >لا يوجد روابط لهذة المحاضرة</div>

                                            @endif

                                        </div>
                                    </div>


                                </div>
                            </div>
                            <hr/>
                            <!-- Tooltip style 1 card end -->
                        </div>


        @endforeach


    </div>
    <div class="row">
        <div class="col-xl-12" >
            <div class="card o-visible" style="min-height: 350px ;padding: 20px;margin-bottom:50px " >
                <div class="card-header" style="background: rgb(167,183,193)">
                    <center> <h5>Homework && exams </h5></center>
                </div>
                <div class="card-block" style="padding: 10px">

                    <div class="row">
                                <div class="pricing-content col-xl">
                                    <div class="pricing-table-list">
                                        <ul class="list-unstyled">
                                            <li><u> Homeworks</u></li>

                                            @foreach($home_works as $home_work)
                                                <?php $active=$home_work->assignment_delivery->where("student_id","=","1")->first()->active ?? "0";?>
                                                <li>
                                                    @if($active=="0")
                                                        <i class="fa fa-times"></i>
                                                    @else
                                                        <i class="fa fa-check"></i>
                                                    @endif



                                                    <u> <a href="{{route("insert_delivery_home_work",$home_work->id)}}"> {{$home_work->title}} </a></u></li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                        <div class="pricing-content col-xl">
                            <div class="pricing-table-list">
                                <ul class="list-unstyled">
                                    <li><u> EXAMS</u></li>
                                    @foreach($exams as $exam)
                                        <li>
                                            <i class="fa fa-warning text-danger"></i>


                                            <u><a href="{{route('show_my_exams',$exam->id)}}">{{$exam->title ??"no title"}} </a></u>->({{ $exam->mark_of_this_exam->mark ??"NO MARK"}}) / FROM ({{$exam->questions->count()}})</li>




                                        </li>
                                        @endforeach



                                </ul>
                            </div>
                        </div>

                    </div>



                </div>
            </div>
            <hr/>
            <!-- Tooltip style 1 card end -->
        </div>
    </div>

    <!-- row closed -->
@endsection
@section('js')

@endsection
