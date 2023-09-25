@extends('layouts.master')
@section('css')

@section('title')

@stop
@endsection

@section('page-header')
    <style>
        td{font-family: "Simplified Arabic";font-weight: bold;font-size: 14px}
        label{font-family: "Simplified Arabic";font-weight: bold;font-size: 16px}
        h6{font-family: "Simplified Arabic";font-weight: bold;font-size: 18px}
    </style>

    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> EXAM QUESTIONS</h4>
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
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">
                    <div class="col-xl"><a href="{{route('exam_pdf',$id_exam)}}" class="btn btn-danger">EX PDF</a></div>

                    </div>


                </div></div></div></div>
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form action="{{route('store_answers')}}" method="post">
                        @csrf
                    @if($questions->count()>0)
                  @foreach($questions as $question)
{{--                      <div class="row">--}}
{{--                          <div class="col-1">--}}
{{--                              --}}


{{--                          </div>--}}
{{--                          <div class="col-1">--}}


{{--                          </div>--}}
{{--                      </div>--}}
                                <h6 style="margin-bottom: 20px;float: right ">    {{$loop->iteration}} :</h6>
                             <h6 style="margin-bottom: 20px"> (  {{$question->question}} ) </h6>


                            <div class="row">
                               @if(is_null($question->answer))
                                    @foreach($question->options as $x=>$option)
                                        <div class="col-xl">

                                            <label for="options_q_{{$question->id}}_{{$x}}">{{$option}}</label> <input type="radio" name="{{$question->id}}" value="{{$option}}" id="options_q_{{$question->id}}_{{$x}}">
                                        </div>

                                    @endforeach
                                   @else
                                    @foreach($question->options as $x=>$option_checked)
                                        <div class="col-xl">


                                            <label for="options_q_{{$question->id}}_{{$x}}">{{$option_checked}}</label> <input type="radio" @if($question->answer==$option_checked) checked @endif name="{{$question->id}}" value="{{$option_checked}}" id="options_q_{{$question->id}}_{{$x}}">
                                        </div>

                                    @endforeach
                                @endif
                            </div>
                            <hr>

{{--                            <div class="remember-checkbox mb-20">--}}
{{--                                <input class="form-check-input" type="checkbox" name="gridRadios" id="gridRadios1" value="option1" checked>--}}
{{--                                <label class="form-check-label mb-0" for="gridRadios1">First radio</label>--}}
{{--                            </div>--}}
                      @endforeach
                            <div class="col-xl"><button class="btn btn-danger" type="submit">SAVE</button></div>
                    </form>

                        @else
                        <div CLASS="alert alert-danger">NO QUESTIONS YET</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
