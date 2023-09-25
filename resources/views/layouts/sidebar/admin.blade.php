
<div class="container-fluid">
    @php
        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                $worlds=["grades"=>"المراحل الدراسية","class_rooms"=>"جميع الصفوف","rooms"=>"ادرارة الصفوف","sections"=>"ادراة الاقسام","parents"=>"اولياء الامور","students"=>"الطلاب","add_student"=>"اضافة طالب جديد","push_students"=>"ترقية الطلاب"];
        }
        else{

            $worlds=["grades"=>"Grades","class_rooms"=>"Class Rooms","rooms"=>"Rooms","sections"=>"Sections","parents"=>"Parents","students"=>"Students","add_student"=>"Add New Student","push_students"=>"Push up Students"];
        }
    @endphp

    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Home</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url("/")}}">index</a> </li>

                        </ul>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{$worlds['grades']}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route("view.grades")}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">{{$worlds["grades"]}}</a></li>

                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{$worlds["rooms"]}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route("view.classrooms")}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">{{$worlds["class_rooms"]}}</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">
                                    {{$worlds["sections"]}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route("sections")}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">عرض جميع الاقسام</a> </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">المعلمين</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('teacher')}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">اضافة معلم جديد</a> </li>
                            <li> <a href="{{route('show-all-teachers')}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">قائمة المعلمين</a> </li>

                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">المواد الدراسية</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('add_material')}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">اضافة مادة جديدة</a> </li>
                            <li> <a href="{{route('get_materials')}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">عرض المواد الدراسية لكل صف</a> </li>
                        </ul>
                    </li>



                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">{{$worlds["parents"]}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('students_parents')}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">اضافة او عرض ولي امر</a> </li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
                            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">{{$worlds["students"]}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('add_students')}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">{{$worlds["add_student"]}}</a> </li>
{{--                            <li> <a href="{{route('push_students')}}">{{$worlds["push_students"]}}</a> </li>--}}
                            <li> <a href="{{route('getall_students')}}" style="font-weight: bold;font-family:'Simplified Arabic'; font-size: 14px;">اظهار الطلاب</a> </li>

                        </ul>
                    </li>
                    <!-- menu item Authentication-->

                    <!-- menu item maps-->
                    <li>
                        <a href="{{route("get_all_messages")}}"><i class="fa fa-send-o"></i><span class="right-nav-text">الرسائل</span>
                            </a>

                </ul>
            </div>

        </div>

        <!-- Left Sidebar End-->

        <!--=================================
