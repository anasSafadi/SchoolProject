<div>
    <table class="table table-hover table- table-bordered p-0" data-page-length="50">
        <thead>
        <tr>
            <th colspan="8" ><center><h3>lIST PARENTS</h3></center></th>
        </tr>
        </thead>
        <tbody>
        <tr style="background: #cfcecd">
            <td>#</td>
            <td>الايميل</td>
            <td>اسم الاب</td>
            <td>المكان</td>
            <td>الوظيفة</td>
            <td>رقم الهاتف</td>
            <td>عدد الاولاد</td>
            <td>ملاحظات</td>
        </tr>
        @foreach($studentParent as $item)
        <tr>
            <td>{{$loop->iteration ?? "NO DATA"}}</td>
            <td>{{$item->email ?? "NO DATA"}}</td>
            <td>{{$item->name_father ?? "NO DATA"}}</td>

            <td>{{$item->my_area->name_area ?? "NO DATA"}}</td>

            <td>{{$item->job_father ?? "NO DATA"}}</td>
            <td>{{$item->phone_father ?? "NO DATA"}}</td>
            <td>{{$item->sons->count() ?? "NO DATA"}}</td>
            <td>





                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" wire:click="delete_parents('{{$item->id}}')"><i  class="fa fa-trash"></i></button></td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
