@extends('layouts.master')
@section('css')
    <link href="{{asset('/filepond/filepond.css')}}" rel="stylesheet" />
@section('title')

@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0" style="font-family: 'Simplified Arabic';font-weight: bold"> تسليم واجبات </h4>
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
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="card border-0 bg-light shadow-sm pb-2">
                    <div class="card-body text-center">
                        <h4 class="card-title">{{$home_work->title}}</h4>
                        <p class="card-text">
                            {{$home_work->descriptions}}
                            <div class="row">
                                @if(isset($home_work->files)&&$home_work->files->count()>0)
                                    @foreach($home_work->files as $file)
                                        <div class="col-xl"><u> <a href="{{route('download_file',$file->url)}}"> {{$file->client_name}}</a></u></div>
                                    @endforeach
                                @else
                                    <div class="col-xl"><u><a href="">-لم يتم ادراج ملفات</a></u></div>

                                @endif

                            </div>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent py-4 px-5">
                        <div class="row border-bottom">
                            <div class="col-6 py-1 text-right border-right">
                                <strong>حالة التسليم</strong>
                            </div>

                                @if($dilever->active=="0")
                                <div class="col-6 py-1 alert-danger">
                                    غير مسلم
                            </div>
                                    @else
                                <div class="col-6 py-1 alert-success">
                                    مسلم للتقيم
                                </div>
                                    @endif

                        </div>
                        <div class="row border-bottom">
                            <div class="col-6 py-1 text-right border-right">
                                <strong>Total Seats</strong>
                            </div>
                            <div class="col-6 py-1">40 Seats</div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-6 py-1 text-right border-right">
                                <strong>اخر موعد للتسليم</strong>
                            </div>
                            <div class="col-6 py-1">{{$home_work->end_date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 py-1 text-right border-right">
                                <strong>ملفاتك</strong>
                            </div>
                            <div class="col-6 py-1">
                                @if(isset($dilever->files)&&$dilever->files->count()>0)
                                    @foreach($dilever->files as $file)
                                        <a href="{{route('download_file',$file->url)}}"> <u><li>{{$file->client_name}} </li></u></a>
                                        @endforeach
                                    @else
                                    <li><lable class="alert-danger">no files</lable></li>
                                    @endif

                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-success px-4 mx-auto mb-4" data-toggle="modal" data-target="#exampleModal">
                       اضف تسليم
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD YOUR FILES</h5>




                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>
            <div class="modal-body" style="padding: 40px">
                <fieldset>
                    <legend>Files</legend>

                    <!-- a list of already uploaded files -->
                    <ol>

                    </ol>

                    <!-- our filepond input -->

                    <input type="file"  name="avatar"  required multiple />
                </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>



                <button  class="btn btn-primary" onclick="save_files()" >Save changes</button>

            </div>
        </div>
    </div>
</div>
<script src="{{asset('/filepond/filepond.js')}}"></script>
<script>
    let files=[];
    const fieldsetElement = document.querySelector('fieldset');
    const pond2 = FilePond.create(fieldsetElement);
    console.log(pond2.files);
    const inputElement = document.querySelector('input[id="avatar"]');
    const pond = FilePond.create(inputElement);
    FilePond.setOptions({
        server: {
            url: '/student/upload_files',
            timeout: false,
            process: {
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                withCredentials: false,
                onload: (response) => {files.push(response);console.log(files);},
                onerror: (response) => console.log("404"),

            },

        },});



  function save_files() {
      $.ajax({

          url: '{{route("store_delivery")}}',
          type: 'post',
          data: {
              '_token':"{{csrf_token()}}",
              'files_path':files,
              "dilever_id":'{{$dilever->id}}'
          },
          success: function (data) {
              if(data.state==true){
                  // send_btn_lecture.className="btn btn-success"
                  // send_btn_lecture.innerHTML="تم الارسال بنجاح";
                  location. reload()
              }
              if(data.state==false){
                  // send_btn_lecture.disabled=false;
                  // send_btn_lecture.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
              }
          },
          error:function (data){
              // if(data.state==false){
              //     send_btn_lecture.disabled=false;
              //     send_btn_lecture.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
              // }

          },


      });

  }






</script>
<!-- row closed -->
@endsection
@section('js')

@endsection
