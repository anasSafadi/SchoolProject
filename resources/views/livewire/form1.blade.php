<div class="card-body">
    <h5 class="card-title" >معلومات الاب</h5>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" wire:model="email" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control"  wire:model="password" placeholder="Password">
            </div>
        </div>
    <div class="form-row">
        <div class="col">
            <input type="text" class="form-control" placeholder="First name" wire:model="name_father">
        </div>
        <div class="col">
            <input type="text" class="form-control" wire:model="father_phone" placeholder="phone">
        </div>
    </div>

        <div class="form-group">
            <label for="inputAddress2">{{$worlds["job"]}}</label>
            <input type="text" class="form-control" wire:model="job_father" >
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">ID</label>
                <input type="text" class="form-control"wire:model="father_id_number">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">location</label>
                <select class="form-select my-1 me-sm-2" wire:model="area_father">
                    <option>areas</option>
                    @foreach($areas as $area)
                        <option value="{{$area->id}}">{{$area->name_area}}</option>
                        @endforeach
                </select>
            </div>
           @error($name_father) <div class="alert alert-danger">{{$message}}</div>@enderror





</div>
    <button wire:click="next_step"  class="btn btn-primary">NEXT</button>
</div>

