<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    @include('layouts.head')
</head>

<body>
@php
    if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
            $worlds=["dashboard"=>"صفحة رئيسية"];
    }
    else{

        $worlds=["dashboard"=>"INDEX"];
    }

@endphp

<div class="wrapper">

    <!--=================================
preloader -->

    <div id="pre-loader">
        <img src="assets/images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================
preloader -->

@include('layouts.main-header')

@include('layouts.main-sidebar')

<!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">

                    <h4 class="mb-0">
                         المواد الدراسية:{{$class->name_class}} {{$class->grade->name}}
                       </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
        <!-- widgets -->
        <div class="row">
            @foreach($materials as $material)

                <div class="col-xl-12  mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1"><h6> مساق   </h6></div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><u>{{$material->material->name}} - {{$material->class_room_of_material->name_class}} - {{$material->class_room_of_material->grade->name}}</u></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> <i class="fa fa-arrow-up" aria-hidden="true"></i>12%</span>
                                        <span>Since last years</span>
                                    </div>
                                </div>

                                <div class="col-auto" style="width: 20%">
                                    <a href="{{route('make_homework',$material->id)}}">
                                        <i class="fa fa-users fa-2x text-info" aria-hidden="true"></i>
                                        <span style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px" class="badge btn btn-secondary " >ادراج واجب منزلي </span>
                                    </a>
                                </div>
                                <div class="col-auto" style="width: 20%">
                                    <a href="{{route("create_lecture",$material->id)}}">
                                        <i class="fa fa-book fa-2x text-secondary" aria-hidden="true"></i>
                                        <span class="badge btn btn-secondary" style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px">محاضرة جديدة</span>
                                    </a>
                                </div>


                                <div class="col-auto" style="width: 20%">
                                    <a href="{{route('create_zoom',$material->id)}}">
                                        <img src="{{asset('zoom.png')}}" width="30"height="30"/>

                                        <span style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px" class="badge btn btn-secondary" >ZOOM</span>
                                    </a>
                                </div>

                                </div>




                        </div>
                    </div>
                </div>






            @endforeach
        </div>
        <!-- Orders Status widgets-->




        <!--=================================
wrapper -->

        <!--=================================
footer -->

        @include('layouts.footer')
    </div><!-- main content wrapper end-->
</div>
</div>
</div>

<!--=================================
footer -->

@include('layouts.footer-scripts')

</body>

</html>
