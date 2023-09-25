@extends('layouts.master')
@section('css')

@section('title')
    empty
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
                                        <u><h6 class="m-0 font-weight-bold text-primary">{{$lec->sub_material->material->name}} {{$lec->sub_material->class_room_of_material->name_class}} {{$lec->sub_material->class_room_of_material->grade->name}}</h6></u>
                                        <button class="float-right btn btn-danger"  id="data_lecture">Send</button>
                                    </div>
                                    <div class="card-body" >
                                        {{--                        @livewireStyles--}}
                                        {{--                        <livewire:teacher.lecture :i_d="$material->id"/>--}}
                                        {{--                        @livewireScripts--}}
                                        <div>


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title</label>
                                                <input type="text" class="form-control" id="title" value="{{$lec->title}}"
                                                       placeholder="العنوان"/>
                                                <small id="emailHelp" class="form-text text-muted">We'll never share your
                                                    email with anyone else.</small>

                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="exampleInputPassword1">description</label>
                                                <input  class="form-control" name="description" id="description" value="{{$lec->description}}">
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group mt-4">
                                                        <div class="custom-file">
                                                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                                                                اضافة روابط
                                                            </button>
                                                            <ul id="list_url" class="m-4">
                                                                @if($lec->urls->count()>0)
                                                                    @foreach($lec->urls as $url)
                                                                        <li style='margin: 10px' id="{{$url->url}}"><i class="fa fa-link"></i> <a href="{{$url->url}}" >{{$url->description}}</a> <button class="badge btn btn-danger" onclick="delete_item('{{$url->description}}','{{$url->url}}')"><i  class="fa fa-trash"></i></button></li>
                                                                    @endforeach
                                                                        @if($lec->urls->count()==0)

                                                                            <li style='margin: 10px' id="no_links" ><div class="alert alert-danger">لا يوجد روابط</div></li>

                                                                        @endif
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mt-4">
                                                        <div class="custom-file">
                                                            <u><h6>ملفات القديمة</h6></u>
                                                            <ul id="list_files" class="m-4">
                                                                @if($lec->files->count()>0)
                                                                    @foreach($lec->files as $file)
                                                                        <li style='margin: 10px' id="{{$file->url}}">
                                                                            <i class="fa fa-file mr-10"></i>
                                                                            {{$file->client_name}}
                                                                            <button class="badge btn btn-danger" onclick="delete_file('{{$file->url}}')">
                                                                                <i  class="fa fa-trash"></i>
                                                                            </button>
                                                                            <a class="badge btn btn-success"  href="{{route("download_files_for_teacher",$file->url)}}"><i  class="fa fa-download"></i></a></li>
                                                                    @endforeach
                                                                    @else
                                                                    <div class="alert alert-danger"> لا يوجد ملفات</div>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                        <hr/>


                                        <div class="row">

                                                @foreach($lec->sub_material->class_room_of_material->all_sections as $section)
                                                <div class="remember-checkbox mb-20 col"><input type="checkbox" @if(array_search($section->id,$ids)>-1) checked @endif class="my_checkbox" value="{{$section->id}}" id="for_{{$section->id}}"/>
                                                    <label class="form-check-label" for="for_{{$section->id}}">{{$section->class_room_of_section->name_class}}-{{$section->name_section}}</label></div>
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

                        let old_description=[];
                        let old_urls=[];
                        let old_files_url=[];
                        let old_files_client_name=[];
                        let list= document.getElementById("list_url");

                            @if($lec->urls->count()>0)
                            @foreach($lec->urls as $url)
                            old_urls.push("{{$url->url}}");
                            old_description.push("{{$url->description}}");
                            @endforeach
                            @endif

                            @if($lec->files->count()>0)

                            @foreach($lec->files as $file)
                            old_files_url.push('{{$file->url}}');
                            old_files_client_name.push('{{$file->client_name}}');

                            @endforeach

                            @endif

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
                                    onload: (response) => {
                                        old_files_url.push(response.split("*")[0]);
                                        old_files_client_name.push(response.split("*")[1]);
                                    },
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

                                    old_description.push(a);
                                    old_urls.push(b);
                                    list.innerHTML=null;
                                    for (let i = 0; i < old_urls.length; i++) {
                                        list.innerHTML=list.innerHTML+"<li style='margin: 10px' id="+
                                            old_files_url[i]+
                                            ">"+
                                            "<i class=\"fa fa-link\"></i>"+
                                            "<a href="+
                                            old_urls[i]+
                                            ">"+
                                            old_description[i]+"</a>"+
                                            "<button class=\"badge btn btn-danger\" "+
                                            "onclick="+
                                            "delete_item('"+
                                            old_description[i]+
                                            old_files_url[i]+
                                            "')"+
                                            ">"+
                                            "<i  class=\"fa fa-trash\"></i></button>"+

                                            "</li>";}
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


                            console.log(document.getElementById("title").value);
                            console.log(all_sections_ids);
                            let send_btn_lecture=document.getElementById('data_lecture');
                           // send_btn_lecture.disabled=true;
                            send_btn_lecture.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>\n' +
                                '  Loading...'
                            $.ajax({

                                url: '{{route("store_edit_lecturer")}}',
                                type: 'post',
                                data: {
                                    '_token':"{{csrf_token()}}",
                                    'id_le':'{{$lec->id}}',
                                    'title': document.getElementById("title").value,
                                    'description': document.getElementById("description").value,
                                    'old_files_url':old_files_url,
                                    'old_files_client_name':old_files_client_name,
                                    'description_url':old_description,
                                    'all_url':old_urls,
                                    'sub_material_id':"20",
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

                        function  delete_item(id_item_des,id_url){
                            console.log(id_item_des);
                            let index=old_description.indexOf(id_item_des);
                            old_description.splice(index,1);
                            old_urls.splice(index,1);
                            document.getElementById(id_url).remove();
                            console.log(old_description);

                        }


                        function delete_file(id_url_file) {
                            console.log(id_url_file);
                            let index=old_files_url.indexOf(id_url_file);
                            old_files_url.splice(index,1);
                            old_files_client_name.splice(index,1);
                            console.log(old_files_client_name);
                            document.getElementById(id_url_file).remove();
                            }






                    </script>






    <!-- row closed -->
@endsection
@section('js')

@endsection
