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
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text"> asdasd</span>
                            </div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="dashboard" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url("/")}}">صفحة الرئيسية</a> </li>

                        </ul>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">Components </li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">المواد الدراسية</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">


                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">محاضرات Zoom</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('show_zoom_lecture')}}" style="font-weight: bold;font-size: 16px;font-family: 'Simplified Arabic'">Zoom</a> </li>

                        </ul>
                    </li>

                </ul>
            </div>

        </div>

        <!-- Left Sidebar End-->

        <!--=================================
