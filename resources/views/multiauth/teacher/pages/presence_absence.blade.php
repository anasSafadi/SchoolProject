@extends('layouts.master')
@section('css')

@section('title')
    empty
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> سجيل حضور وغياب</h4>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Grade_id">المرحلة الدراسية: <span class="text-danger">*</span></label>
                                /**1**/                                <select class="custom-select mr-sm-2" id="grade_id" onclick="get_class($(this).val())">
                                    <option selected disabled>Choose....</option>
                                    @foreach($grades as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Classroom_id">الصف الدراسي : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="classroom_id" onclick="get_sections_and_sub($(this).val())">

                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_id">المادة : </label>
                                <select class="custom-select mr-sm-2" id="sub_id" onclick="get_material_id($(this).val())">
                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_id">القسم : </label>
                                <select class="custom-select mr-sm-2" id="section_id" onclick="get_student_by_section($(this).val())">
                                    <option selected disabled>Choose....</option>
                                </select>
                            </div>
                        </div>

                    </div>




                    <br>

                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
        <table class="table table-hover table- table-bordered p-0" id="table_data">
            <tr style="background: #c9c9c9">
                <td>
                    اسم الطالب
                </td>
                <td>
                    الحضور
                </td>

            </tr>

            <tr>
                <td>No DATA</td>
                <td>No DATA</td>

            </tr>
        </table>
        <button class="btn btn-danger" id="send_data_btn" onclick="send_data()">ارسل</button>
                            </div></div>
                    </div></div></div></div></div>


    <!-- row closed -->
    <script>
        let id_of_sub_m=null;
        let id_of_section=null;
        function get_class(id) {
            console.log(id);
            if(id>0){
                $.ajax({
                    type:'post',
                    url:'{{route('get_class_for_teacher')}}',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id':id,
                    },
                    success:function (data){
                        if(data.state==true){
                            console.log( data.items);
                            var list_class=document.getElementById("classroom_id");
                            list_class.innerHTML="<option selected disabled>Choose....</option>";
                            data.items.forEach(element =>list_class.innerHTML=list_class.innerHTML+"<option value="+element[0]+">" + element[1] + '</option>');

                        }

                    }
                });}
        }
        function get_sections_and_sub(id) {
            console.log(id);
            if(id>0){
                $.ajax({
                    type:'post',
                    url:'{{route('get_sub_by_class_id')}}',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'id_of_class':id,
                    },
                    success:function (data){
                        if(data.state==true){

                            var list_class=document.getElementById("section_id");
                            list_class.innerHTML="<option selected disabled>Choose....</option>";
                            data.sections.forEach(element =>list_class.innerHTML=list_class.innerHTML+"<option value="+element[0]+">" + element[1] + '</option>');

                            var list_sub=document.getElementById("sub_id");
                            list_sub.innerHTML="<option selected disabled>Choose....</option>";
                            data.sub_materials.forEach(element =>list_sub.innerHTML=list_sub.innerHTML+"<option value="+element[0]+">" + element[1] + '</option>');

                        }

                    }
                });}
        }

        function get_student_by_section(id) {
            id_of_section=id;
            let up_row=document.createElement("tr");
            up_row.style.background="#9ac99b"

            let col1=document.createElement("td");
            col1.appendChild(document.createTextNode("الاسم"));

            let col2=document.createElement("td");
            col2.appendChild(document.createTextNode("الحالة"));

            up_row.appendChild(col1);
            up_row.appendChild(col2);







            if(id>0){
                $.ajax({
                    type:'post',
                    url:'{{route('get_student_by_section')}}',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'section_id':id,
                    },
                    success:function (data){
                        if(data.state==true){
                            let students=data.students;

                            var table=document.getElementById("table_data");
                            table.innerHTML=null;
                            table.appendChild(up_row);

                            for (let i = 0; i < students.length; i++) {

                                let label_text_A=document.createElement("label");
                                label_text_A.innerText="حضور";
                                label_text_A.setAttribute("for",`student_${students[i][0]}`);
                                label_text_A.style.fontSize="20px"
                                let active_btn=document.createElement("input");
                                active_btn.setAttribute("type","radio");
                                active_btn.setAttribute("name",`student_${students[i][0]}`);
                                active_btn.setAttribute("id",`student_${students[i][0]}`);
                                active_btn.setAttribute("value",students[i][0]);
                                active_btn.className="success";


                                let label_text_not_A=document.createElement("label");
                                label_text_not_A.innerText="غياب";
                                label_text_not_A.setAttribute("for",`not_student_${students[i][0]}`);

                                label_text_not_A.style.marginRight="20px";
                                label_text_not_A.style.fontSize="20px"
                                let not_active_btn=document.createElement("input");
                                not_active_btn.setAttribute("type","radio");
                                not_active_btn.setAttribute("name",`student_${students[i][0]}`);
                                not_active_btn.setAttribute("id",`not_student_${students[i][0]}`);
                                not_active_btn.setAttribute("value",students[i][0]);
                                not_active_btn.className="not_success";


                                let row=table.insertRow();
                                let name_lable=document.createElement("label");
                                let name=document.createTextNode(students[i][1]);
                                name_lable.appendChild(name);
                                name_lable.style.fontSize="20px";

                                let c1=row.insertCell();
                                c1.appendChild(name_lable);
                                //console.log(c1.firstElementChild.firstElementChild.nodeValue)
                                let c2=row.insertCell();
                                c2.appendChild(label_text_A);
                                c2.appendChild(active_btn);

                                c2.appendChild(label_text_not_A);
                                c2.appendChild(not_active_btn);




                            }




                        }

                    }
                });}
        }
        function send_data() {
           let send_data_btn=document.getElementById('send_data_btn');

            Presence_student=[];
            absence_sudents=[];

            let all_success_btn=document.getElementsByClassName("success");
            let all_not_success_btn=document.getElementsByClassName("not_success");

            all_student_count=all_success_btn.length;



            for(let i=0 ;i<all_success_btn.length;i++){
                if(all_success_btn[i].checked==true){
                    Presence_student.push(all_success_btn[i].value);

                }
            }

            for(let i=0 ;i<all_not_success_btn.length;i++){
                if(all_not_success_btn[i].checked==true){
                    absence_sudents.push(all_not_success_btn[i].value);

                }

            }
            if(Presence_student.length+absence_sudents.length!=all_student_count){
                let all_real_student=[];

                let all_write_Presence_and_absencestudent=[];
                 let all_not_get_Presence_and_absence=[];


                for(let i2=0 ;i2<all_success_btn.length;i2++){
                    all_real_student.push(all_success_btn[i2].value);
                }

                all_real_student=all_real_student.sort();

                sort_Presence=Presence_student.sort();
                sort_Presence.forEach(item=>all_write_Presence_and_absencestudent.push(item));

                sort_absence=absence_sudents.sort();
                sort_absence.forEach(item=>all_write_Presence_and_absencestudent.push(item));


                let sub=all_real_student.length-all_write_Presence_and_absencestudent.length;

                for(let i3=0;i3<all_write_Presence_and_absencestudent.length;i3++){
                    const index =all_real_student.indexOf(all_write_Presence_and_absencestudent[i3].toString());
                    if(index!=-1){
                        all_real_student.splice(index, 1);
                    }



                }
                console.log("not get data"+all_real_student);






            }

            else{

                if(id_of_sub_m!=null&&Presence_student.length>0||absence_sudents.length>0){
                    send_data_btn.disabled=true;
                    send_data_btn.innerText="pressing.."
            $.ajax({

                url: '{{route("store_presence_absence")}}',
                type: 'post',
                data: {
                    '_token':"{{csrf_token()}}",
                    'presence': Presence_student,
                    'absence': absence_sudents,
                    "id_sub":id_of_sub_m,
                    "id_section":id_of_section,

                },
                success: function (data) {
                    if(data.state==true){
                        send_data_btn.className="btn btn-success"
                        send_data_btn.innerHTML="تم الارسال بنجاح";
                        location. reload()
                    }
                    if(data.state==false){
                        send_data_btn.disabled=false;
                        send_data_btn.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
                    }
                },
                error:function (data){
                    if(data.state==false){
                        send_data_btn.disabled=false;
                        send_data_btn.innerHTML="حدث خطا اثناء الارسال اعد الارسال";
                    }

                },






        });}}}

        function get_material_id(id) {
            id_of_sub_m=id;
        }

    </script>
@endsection
@section('js')


@endsection
