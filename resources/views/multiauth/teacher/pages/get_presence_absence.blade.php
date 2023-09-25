@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
    @php
        if (\Illuminate\Support\Facades\App::getLocale()=="ar"){
                $worlds=["add_section"=>"اضافة قسم","name_grade"=>"اسم المرحلة","name_class"=>"اسم الصف","name_section"=>"اسم القسم"];
        }
        else{

            $worlds=["add_section"=>"Add section","name_grade"=>"name grade","name_class"=>"name class","name_section"=>"name section"];
        }

    @endphp


    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">


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

    @foreach($grades as $grade)
                    <div class="row">


                                <div class="col-xl-12 mb-30">
                                    <div class="card card-statistics h-100">
                                        <div class="card-body">
                                            <h5 class="card-title">سجلات الحضور والغياب<br> {{$grade->name}}</h5>

                                            <div class="accordion plus-icon shadow">


                                                    <?php
                                                    $ids_of_class=[];
                                                    $id=\Illuminate\Support\Facades\Auth::guard("teacher")->id();
                                                    $teacher=\App\Models\Teacher::find($id);
                                                    $all_my_class =\Illuminate\Support\Facades\DB::table('sub_material')->select("classroom_id")->where("grade_id",$grade->id)->where("teacher_id",$id)->distinct()->get();

                                                    foreach ($all_my_class as $my_class){
                                                        array_push($ids_of_class, $my_class->classroom_id);
                                                    }
                                                    $class_rooms=\App\Models\Teacher\Classroom::find($ids_of_class);
                                                    ?>
                                                   @foreach($class_rooms as $class)
                                                            <h5>{{$class->name_class}}-{{$grade->name}}</h5>

                                                            @foreach($class->sub_material->where("teacher_id","=",\Illuminate\Support\Facades\Auth::guard("teacher")->id()) as  $material)

                                                                <div class="acd-group">
                                                                    <?php $class_of_sub=$material->class_room_of_material;?>
                                                                    <a href="#" class="acd-heading">{{$material->material->name}} {{$class_of_sub->name_class}} {{$class_of_sub->grade->name}}</a>
                                                                    <div class="acd-des">

                                                                        @foreach($class_of_sub->all_sections as $section)
                                                                            <h6>{{$material->class_room_of_material->name_class}}-{{$section->name_section}}</h6>
                                                                            <table class="table table-hover table- table-bordered p-0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th scope="col">اسم الطالب</th>
                                                                                    @foreach($section->Presence_and_absence->where("sub_material_id",$material->id) as $item)
                                                                                        <th scope="col">{{$item->title}}</th>
                                                                                    @endforeach
                                                                                    <th>الحضور الكلي</th>

                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                @foreach($section->students as $student)
                                                                                    <?php $count=0;$total=0;?>
                                                                                    <tr>
                                                                                        <th>{{$student->name}}</th>
                                                                                        @foreach($student->Presence_and_absence->where("sub_material_id",$material->id) as $item)
                                                                                            <th>@if($item->pivot->active=="1")
                                                                                                    <?php $count++;
                                                                                                    ?>
                                                                                                @endif
                                                                                                {{$item->pivot->active}}</th>

                                                                                            <?php $total++;?>

                                                                                        @endforeach
                                                                                        <th>{{$total}}/{{$count}}</th>

                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                            <hr>
                                                                        @endforeach


                                                                    </div>
                                                                </div>

                                                            @endforeach


                                                       <hr><hr>
                                                       @endforeach




                                            </div>
                                        </div>
                                    </div>
                                </div>







                    </div>
                    @endforeach





    <script src="{{asset('https://code.jquery.com/jquery-3.6.3.min.js')}}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

@endsection
@section('js')

@endsection
