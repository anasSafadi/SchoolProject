<div>
<div class="card-body">
    <h5 class="card-title">معلومات الام</h5>
    <div class="row">
         <div class="col-6"><label>اسم الام</label> <input type="text" class="form-control" placeholder="اسم الام" ></div>
        <div class="col-6"> <label>رقم الهاتف</label><input type="text" class="form-control" placeholder="رقم الهاتف"></div>
    </div>
    <div class="row">
        <div class="col-6"><label>رقم البطاقة</label> <input type="text" class="form-control" placeholder="رقم البطاقة" ></div>
        <div class="col-6"> <label>مكان السكن</label><select type="text" class="form-select my-1 me-sm-2" >@foreach($areas as $item)<option selected>area</option><option value="{{$item->id}}">{{$item->name_area}}</option>@endforeach</select></div>
    </div>



    <div style="margin-top: 30px">
        <button wire:click="back_step"  class="btn btn-danger">Back</button>
        <button wire:click="next_step"  class="btn btn-primary">NEXT</button></div>


</div>
</div>
