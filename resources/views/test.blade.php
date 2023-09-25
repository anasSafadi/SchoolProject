
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<h1 id="header">{{$test->arr[$test->x]}}</h1>
<br>
<input id="name" type="text"/>
<br>
<button onclick="send()">set name</button>
<script>
function send() {
    $.ajax({

        url: '{{route("insert_name")}}',
        type: 'post',
        data: {
            '_token':"{{csrf_token()}}",
            "name":document.getElementById('name').value,
        },
        success: function (data) {
            if(data.state==true){
                console.log(data.data);
                console.log(data.x);
                // send_btn_lecture.className="btn btn-success"
                // send_btn_lecture.innerHTML="تم الارسال بنجاح";
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

