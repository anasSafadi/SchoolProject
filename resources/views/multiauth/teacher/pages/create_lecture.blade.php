@extends('layouts.master')
@section('css')

@section('title')

@stop
@endsection
@section('page-header')
    <link href="{{asset('/filepond/filepond.css')}}" rel="stylesheet" />
    <script src="{{asset('https://code.jquery.com/jquery-3.6.3.min.js')}}" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="{{asset('/filepond/filepond.js')}}"></script>
    <!-- breadcrumb -->

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">

                    <style>
                        .closebtn {
                            margin-left: 15px;
                            color: white;
                            font-weight: bold;
                            float: right;
                            font-size: 22px;
                            line-height: 20px;
                            cursor: pointer;
                            transition: 0.3s;
                        }

                        .closebtn:hover {
                            color: black;
                        }</style>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">وصف الرابط</label>
                                        <input type="text" class="form-control" id="desc_link">
                                    </div>

                                    <div class="form-group mt-2">
                                        <label for="exampleInputPassword1">الرابط</label>
                                        <input  class="form-control" id="link" >
                                    </div>

                                </div>
{{--                                <div class="alert alert-danger" id="show_the_alert" style="margin: 15px;display: none" >--}}
{{--                                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>--}}
{{--                                    <strong>Danger!</strong>--}}
{{--                                </div>--}}
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                                    <button type="button" class="btn btn-primary" id="save_data">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>



                            <div class="col-lg-12">
                                <!-- Form Basic -->
                                <div class="card mb-6">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">ادراج حصة دراسية جديدة</h6>
                                        <button class="float-right btn btn-danger"  id="data_lecture">Send</button>
                                    </div>
                                    <div class="card-body" >
                                        {{--                        @livewireStyles--}}
                                        {{--                        <livewire:teacher.lecture :i_d="$material->id"/>--}}
                                        {{--                        @livewireScripts--}}
                                        <div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title</label>
                                                <input type="text" class="form-control" id="title"
                                                       placeholder="العنوان">
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your
                                                    email with anyone else.</small>

                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="exampleInputPassword1">description</label>
                                                <input  class="form-control" name="description" id="description">
                                            </div>
                                            <div class="form-group mt-4">
                                                <div class="custom-file">
                                                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                                        اضافة روابط
                                                    </button>
                                                    <ul id="list_url" class="m-4">
                                                        <div>no links</div>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <hr/>


                                        <div class="row">
                                            @foreach($sub_materia->class_room_of_material->all_sections as $section)
                                                <div class="remember-checkbox mb-20 col"><input type="checkbox"  checked class="my_checkbox" value="{{$section->id}}" id="for_{{$section->id}}"/>
                                                    <label class="form-check-label" for="for_{{$section->id}}">{{$sub_materia->class_room_of_material->name_class}}-{{$section->name_section}}</label></div>
                                                @endforeach
                                        </div>

                                        <hr/>

                                        <fieldset>
                                            <legend>Files</legend>

                                            <!-- a list of already uploaded files -->
                                            <ol>

                                            </ol>

                                            <!-- our filepond input -->

                                            <input type="file"  name="avatar"  required multiple />
                                        </fieldset>


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <script>
                        let description=[];
                        let urls=[];
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
                        $(document).on("click","#save_data",function (e) {
                            e.preventDefault();
                            let a=document.getElementById("desc_link").value;
                            console.log(a.split(' '));
                            if(a==""){document.getElementById('show_the_alert').style.display='block';}
                            let b=document.getElementById("link").value;
                            if(b==""){document.getElementById('show_the_alert').innerText="يجب اضافة رابط";}
                            if(b!=""&&a!=""){
                                if(!b.includes("https://")||!b.includes("https://")){document.getElementById('show_the_alert').innerText="يجب اضافة رابط صالح !!";}
                                else{

                                    description.push(a);
                                    urls.push(b);
                                    let list= document.getElementById("list_url");
                                    list.innerHTML="<div>"+"all of your links"+"</div>"
                                    for (let i = 0; i < urls.length; i++) {
                                        list.innerHTML=list.innerHTML+"<li>"+"<i class=\"fa fa-link\"></i>"+" "+
                                            "<a href="+
                                            urls[i]+
                                            ">"+
                                            description[i]+"</a>"+"</li>";}
                                    document.getElementById("desc_link").value="";
                                    document.getElementById("link").value="";

                                    document.getElementById("close").click();}}


                        });
                        /**send the data**/
                        $(document).on("click","#data_lecture",function (e) {
                            e.preventDefault();
                            let all_sections=document.getElementsByClassName("my_checkbox");
                            let all_sections_ids=[];
                            for (var i = 0; i < all_sections.length;i++) {
                                if(all_sections[i].value>0 && all_sections[i].checked == true){

                                    all_sections_ids.push(all_sections[i].value);}
                            }


                            console.log(all_sections_ids);
                            let send_btn_lecture=document.getElementById('data_lecture');
                            send_btn_lecture.disabled=true;
                            send_btn_lecture.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
                                '  Loading...'
                            $.ajax({

                                url: '{{route("store_lecture")}}',
                                type: 'post',
                                data: {
                                    '_token':"{{csrf_token()}}",
                                    'title': document.getElementById("title").value,
                                    'description': document.getElementById("description").value,
                                    'files_path':files,
                                    'description_url':description,
                                    'all_url':urls,
                                    'sub_material_id':"{{$sub_materia->id}}",
                                    "all_sections_ids":all_sections_ids,
                                },
                                success: function (data) {
                                    if(data.state==true){
                                        send_btn_lecture.className="btn btn-success"
                                        send_btn_lecture.innerHTML="تم الارسال بنجاح";
                                        location. reload()
                                    }
                                    if(data.state==false){
                                        send_btn_lecture.disabled=false;
                                        send_btn_lecture.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
                                    }
                                },
                                error:function (data){
                                    if(data.state==false){
                                        send_btn_lecture.disabled=false;
                                        send_btn_lecture.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
                                    }

                                },


                            });
                        });




                    </script>






    <!-- row closed -->
@endsection
@section('js')

@endsection
