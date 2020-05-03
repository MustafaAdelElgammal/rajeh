<table id="data_table" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">مقدم الخدمة </th>
        <th class="sorting">نوع الباقة</th>
        <th class="sorting">كود الدفع</th>
        <th class="sorting">طريقة الدفع</th>
{{--        <th class="sorting">نوع الدفع</th>--}}
        <th class="nosort">العمليات</th>
        <th class="nosort"></th><th ></th>
    </tr>
    </thead>
    <tbody>
    @foreach($payment_packages as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->provider->name_ar}}</td>
            <td>{{$row->package->name_ar}}</td>
            <td>{{$row->promocode->code}}</td>
            <td>@if(!empty($row->promocode->code)) {{$row->promocode->code}}@else لم يتم تعيين الكود @endif </td>
{{--            <td>{{$row->payment}}</td>--}}
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('payment-packages.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('payment-packages.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
