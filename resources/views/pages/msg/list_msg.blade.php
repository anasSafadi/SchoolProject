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

                    </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>
        <!-- widgets -->
        <a  href="{{route("delete_all_msg_from_admin")}}" class="btn btn-danger mb-10">حذف كل الرسائل</a>
        <div class="row">
            @foreach($msg as $message)

                <div class="col-xl-12  mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><u>{{$message->title_msg}}</u></div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span>{{$message->content_msg}}</span>
                                    </div>
                                </div>

                               @if($message->web_count_receivers>-1) <div class="col-auto" style="width: 20%">
                                    <p style="color: #ff070e">WBE MSG</p>
                                    <a href="#">
                                        <span style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px" class="badge btn btn-secondary">receivers:{{$message->web_count_receivers}}</span>
                                        <span style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px" class="badge btn btn-secondary"> ALL: {{$message->total_count_receivers}}</span>

                                    </a>

                                </div>@endif

                                @if($message->gmail_count_receivers>-1) <div class="col-auto" style="width: 20%">
                                    <p style="color: #ff070e">Gmail MSG</p>
                                    <a href="#">
                                        <span style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px" class="badge btn btn-secondary">receivers: {{$message->gmail_count_receivers}}</span>
                                        <span style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px" class="badge btn btn-secondary"> ALL: {{$message->total_count_receivers}}</span>

                                    </a>

                                </div>@endif

                                @if($message->sms_count_receivers>-1) <div class="col-auto" style="width: 20%">
                                    <p style="color: #ff070e">SMS MSG</p>
                                    <a href="#">
                                        <span style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px" class="badge btn btn-secondary">receivers: {{$message->sms_count_receivers}}</span>
                                        <span style="margin-left: 10px ;color: white;font-size: 15px;padding: 10px" class="badge btn btn-secondary"> ALL: {{$message->total_count_receivers}}</span>

                                    </a>

                                </div>@endif

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
