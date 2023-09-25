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

        <style>
            td{
                font-size: 14px;
                font-weight: bold;
                font-family: "Simplified Arabic";
            }

            li{
                font-size: 14px;
                font-weight: bold;
                font-family: "Simplified Arabic";
            }
            h4{
                font-size: 20px;
                font-weight: bold;
                font-family: "Simplified Arabic";
            }
        </style>

        <br>
        <div class="content-wrapper">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-12" >

                        <div class="col-xl-12 mb-10 " style="border-radius: 20px">
                            <div class="card card-statistics h-100" style="border-radius: 20px">
                                <div class="card-body" style="border-radius: 20px">
                                  <center>
                                    <h4 class="mb-0">{{$worlds["dashboard"]}}  لوحة تسجيل دخول الادمن  </h4></center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <center><h5 class="card-title">جميع المعلومات العامة في النظام</h5></center>
                        <div class="accordion gray plus-icon round">
                            @foreach($g as $grade)
                            <div class="acd-group">

                                <a href="#" class="acd-heading" style="font-family: 'Simplified Arabic';font-weight: bold"> {{$grade->name}}



                                </a>


                                <div class="acd-des">


                                    <div class="col-sm-6 mb-4">
                                        <ul class="list list-hand">
                                            <li>  عدد الطلاب الكلي
                                                {{ $grade->students->count()}} </li>
                                            <li>  عدد المدرسين الكلي
                                                {{$count_teacher_in_grades}}  </li>

                                        </ul>
                                    </div>


                                        <div class="table-responsive">

                                            <table class="table table-1 table-bordered table-striped mb-0">
                                                <thead>
                                                <tr>
                                                    <th>الصف الدراسي  </th>
                                                    <th>عدد الطلاب الموجودين</th>
                                                    <th>عدد مدرسين الصف</th>
                                                    <th>الاقسام</th>


                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($grade->all_class_rooms as $class)
                                                    <?php $real_count=[]?>
                                                    @if (isset($count_teacher_in_class[$class->id]))


                                                        @foreach ($count_teacher_in_class[$class->id] as $item )
                                                            <?php $real_count[$item]="haha"?>
                                                        @endforeach

                                                    @endif
                                                <tr>
                                                    <td>{{$class->name_class}} {{$grade->name}}</td>
                                                    <td>{{$class->students->count()}}</td>
                                                    <td>  {{count($real_count)}}</td>
                                                    <td>@foreach($class->all_sections as $section)
                                                            (  {{$class->name_class}} - {{$section->name_section}} )
                                                               @endforeach

                                                    </td>

                                                </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>


                                    <hr>






                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>            <!-- widgets -->
{{--            @foreach($g as $grade)--}}

{{--                <div class="row">--}}
{{--                    <div class="col-xl-12 col-lg-12 col-md-6 mb-30">--}}
{{--                        <div class="card card-statistics h-100">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="clearfix">--}}
{{--                                    <div class="float-left">--}}
{{--                                    <span class="text-danger">--}}
{{--                                        <i class="fa fa-bar-chart-o highlight-icon" aria-hidden="true"></i>--}}
{{--                                    </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="float-right text-right">--}}
{{--                                        <h3 class="card-text text-dark">{{$grade->name}}</h3>--}}
{{--                                        <h4> عدد الطلاب الموجودين  {{$grade->students->count()}} </h4>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="text-muted pt-3 mb-0 mt-2 border-top">--}}
{{--                                    <i class="fa fa-exclamation-circle mr-1" aria-hidden="true"></i>--}}
{{--                                    عدد المدرسين الموجودين في {{$grade->name}}  {{$count_teacher_in_grades}}--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                  @foreach($grade->all_class_rooms as $class)--}}
{{--                    <div class="col-xl-6 col-lg-6 col-md-6 mb-30">--}}
{{--                        <div class="card card-statistics h-100">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="clearfix">--}}
{{--                                    <div class="float-left">--}}
{{--                                    <span class="text-info">--}}
{{--                                        <i class="fa fa-user highlight-icon" aria-hidden="true"></i>--}}
{{--                                    </span>--}}
{{--                                    </div>--}}
{{--                                    <div class="float-right text-right">--}}
{{--                                        <h3 class="card-text text-dark">{{$class->name_class}}</h3>--}}
{{--                                       <u> <h4> عدد الطلاب الموجودين  {{$class->students->count()}} </h4></u>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <p class="text-muted pt-3 mb-0 mt-2 border-top">--}}
{{--                                    <i class="fa fa-calendar mr-1" aria-hidden="true"></i>--}}
{{--                                    <?php $real_count=[]?>--}}
{{--                                    @if (isset($count_teacher_in_class[$class->id]))--}}
{{--                                        --}}
{{--                                    --}}
{{--                                    @foreach ($count_teacher_in_class[$class->id] as $item )--}}
{{--                                    <?php $real_count[$item]="haha"?>--}}
{{--                                    @endforeach--}}

{{--                                    @endif--}}
{{--                                    عدد مدرسين صف  {{$class->name_class}} {{count($real_count)}}--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <hr/><hr/>--}}
{{--                @endforeach--}}

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
