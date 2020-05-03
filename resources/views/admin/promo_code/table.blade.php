<table id="" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">كود رقم</th>
        <th class="sorting">المرات المتاحة للاستخدام</th>
        <th class="nosort">عدد مرات الاستخدام</th>
        <th class="nosort">تاريخ التفعيل</th>
        <th class="nosort">تاريخ الانتهاء</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($promo_code  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->code}}</td>
            <td>{{$row->amount}}</td>
            <td>{{$row->used_number }}</td>
            <td>{{$row->activate_at}}</td>
            <td>{{$row->expired_at}}</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('promo_code.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('promo_code.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
