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

                        <h4 class="mb-0"></h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row">
{{--                @foreach($grades as $grade)--}}


{{--                            <div class="col-xl-6  mb-4">--}}
{{--                            <div class="card h-100">--}}
{{--                                <a href="{{route('grade_show_my_class',$grade->id)}}">--}}
{{--                                <div class="card-body">--}}

{{--                                    <div class="row no-gutters align-items-center">--}}
{{--                                        <div class="col mr-2">--}}
{{--                                            <div class="text-xs font-weight-bold text-uppercase mb-1"><h6></h6></div>--}}
{{--                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><u>--}}
{{--                                                    {{$grade->name}}--}}


{{--                                            </u></div>--}}
{{--                                        <div class="mt-2 mb-0 text-muted text-xs">--}}
{{--                                            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> <i class="fa fa-arrow-up" aria-hidden="true"></i>12%</span>--}}
{{--                                            <span>Since last years</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}




{{--                                </div>--}}

{{--                            </div>--}}
{{--                                </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}






{{--                @endforeach--}}
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <h5 class="card-title" style="font-weight: bold">قائمة المراحل الدراسية التي تدرسها </h5>
                                <div class="accordion gray plus-icon round">
                                    <div class="acd-group" style="display: none">
                                        <a href="#"   class="acd-heading" style="font-weight: bold"> صفوف  مرحلة ;l'kl'   </a>
                                        <div class="acd-des">




                                                <a href="">
                                                    <div class="card-body" >

                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div class="text-xs font-weight-bold text-uppercase mb-1"><h6></h6></div>
                                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><u>
                                                                   l;'l';l;';

                                                                    </u></div>

                                                            </div>




                                                        </div>

                                                    </div>
                                                </a>
                                                <hr>





                                        </div>
                                    </div>
                                    @php
                                        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                                                $worlds=["dashboard"=>"صفحة رئيسية","test"=>"صفوف  مرحلة"];
                                        }
                                        else{

                                            $worlds=["dashboard"=>"INDEX","test"=>"List Class of grade"];
                                        }

                                    @endphp
                                    @foreach($grades as $x=>$grade)
                                        <div class="acd-group">
                                            <a href="#"   class="acd-heading" style="font-weight: bold"> {{$worlds['test']}} {{$grade->name}}   </a>
                                            <div class="acd-des">
                                                @foreach($grade->all_class_rooms as $class)



                                                            <a href="{{route("class_show_my_material",$class->id)}}">
                                                                <div class="card-body" >

                                                                    <div class="row no-gutters align-items-center">
                                                                        <div class="col mr-2">
                                                                            <div class="text-xs font-weight-bold text-uppercase mb-1"><h6></h6></div>
                                                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><u>
                                                                                    {{$class->name_class}} {{$class->grade->name}}


                                                                                </u></div>

                                                                        </div>




                                                                    </div>

                                                                </div>
                                                            </a>
                                                    <hr>







                                                @endforeach

                                            </div>
                                        </div>
                                        @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
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
<script>
    document.getElementById("test_0").click();
</script>

    @include('layouts.footer-scripts')
{{--<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>--}}


<script>


</script>
</body>



</html>
