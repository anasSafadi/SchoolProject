
@extends('layouts.master')
@section('css')
@section('title')
    اضافة حصة جديدة
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة حصة جديدة
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<br>
<style>
    label{font-size: 14px;font-weight: bold;font-family: "Simplified Arabic"}
</style>
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{route('store_zoom',$sub_material->id)}}" autocomplete="off">
                    @csrf


                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>عنوان الحصة : <span class="text-danger">*</span></label>
                                <input class="form-control" name="topic" type="text">
                            </div>
                        </div>




                        <div class="col-md-4">
                            <div class="form-group">
                                <label>تاريخ ووقت الحصة : <span class="text-danger">*</span></label>
                                <input class="form-control" type="datetime-local" name="start_time">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>مدة الحصة بالدقائق : <span class="text-danger">*</span></label>
                                <input class="form-control" name="duration" type="text">
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>كلمة المرور  : <span class="text-danger">*</span></label>
                                <input class="form-control" name="password" type="text">
                            </div>
                        </div>


                    </div>
                    <hr/>
                    <h6 class="mb-10">
                    اختيار الاقسام</h6>

                    <div class="row">
                        @foreach($sub_material->class_room_of_material->all_sections as $section)
                            <div class="remember-checkbox mb-20 col"><input type="checkbox"  checked class="my_checkbox" value="{{$section->id}}" id="for_{{$section->id}}"/>
                                <label class="form-check-label" for="for_{{$section->id}}">{{$sub_material->class_room_of_material->name_class}}-{{$section->name_section}}</label></div>
                        @endforeach
                    </div><br>
                    <input id="sections_ids" type="text" name="sections_of_zoom" hidden/>
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                            onclick="get_sections()"
                        type="submit">{{ trans('Students_trans.submit') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    <script>
        function get_sections() {

            let all_sections=document.getElementsByClassName("my_checkbox");
            let all_sections_ids=[];
            for (var i = 0; i < all_sections.length;i++) {
                if(all_sections[i].value>0 && all_sections[i].checked == true){

                    all_sections_ids.push(all_sections[i].value);}
            }
            document.getElementById("sections_ids").value=all_sections_ids;
        }
    </script>

@endsection
