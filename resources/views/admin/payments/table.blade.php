<table id="data_table" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">مقدم الخدمة </th>
        <th class="sorting">نوع الباقة</th>
        <th class="sorting">الكمية</th>
        <th class="sorting">الحالة</th>
        <th class="sorting">حالة الدفع</th>
        <th class="nosort">العمليات</th>
        <th class="nosort"></th><th ></th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->provider->name_ar}}</td>
            <td>{{$row->package->name_ar}}</td>
            <td>{{$row->amount}}</td>
            <td>@if($row->status =='pending')انتظار @elseif($row->status =='paid') مدفوعة @else غير مدفوعة @endif</td>
            <td>@if($row->type =='payment')مدفوعة @elseif($row->type =='refund') مسترجع  @endif</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('payments.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('payments.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
