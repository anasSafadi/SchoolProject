<div class="container-fluid">
    @php
        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                $worlds=["grades"=>"المراحل الدراسية","class_rooms"=>"جميع الصفوف","rooms"=>"ادرارة الصفوف","sections"=>"ادراة الاقسام","parents"=>"اولياء الامور","students"=>"الطلاب","add_student"=>"اضافة طالب جديد","push_students"=>"ترقية الطلاب"];
        }
        else{

            $worlds=["grades"=>"Grades","class_rooms"=>"Class Rooms","rooms"=>"Rooms","sections"=>"Sections","parents"=>"Parents","students"=>"Students","add_student"=>"Add New Student","push_students"=>"Push up Students"];
        }
    @endphp

    <style>
        a{
           font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;
        }
    </style>
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>


                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{\Illuminate\Support\Facades\Auth::guard("teacher")->teacher()->name}}</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{url("/")}}>Index</a> </li>
                        </ul>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">المحاضرات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('get_lectures_for_teacher')}}" style="  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">جميع المحاضرات</a></li>

                            <li> <a href="{{route('zoom.lectures')}}" style="  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">جميع محاضرات zoom</a> </li>


                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
                            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">الاختبارات</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('new_exam')}}" style="  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">اختبار جديد</a> </li>
                            <li> <a href="{{route('get_all_exams')}}" style="  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">جميع الاختبارات</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">الحضور والغياب</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url("/teacher/index/presence_absence")}}" style="  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">تسجيل حضور وغياب</a> </li>
                            <li> <a href="{{route('get_presence_absence')}}" style="  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">سجلات الحضور والغياب</a> </li>
                        </ul>
                    </li>

                    <!-- menu item Authentication-->

                    <!-- menu item maps-->
                    <li>
                        <a href="{{route('get_all_homework')}}" style="  font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;"><i class="ti-location-pin"></i><span class="right-nav-text">النشاطات البيتية</span>
                            <span class="badge badge-pill badge-success float-right mt-1"><i class="fa fa-home"></i></span></a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Left Sidebar End-->

        <!--=================================
