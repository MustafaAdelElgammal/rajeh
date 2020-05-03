
<table id="" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="sorting_asc">اسم العميل</th>
        <th class="nosort">مزود الخدمة</th>
        <th class="nosort">الخدمة الثانوية</th>
        <th class="nosort">المنتجات</th>
        <th class="nosort">الحالة</th>
        <th class="nosort">العمليات</th>
    </tr>
    </thead>
    <tbody>

    @foreach($orders as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->client->name}}</td>
            @if(isset($row->provider))
            <td>{!! $row->provider->name_ar !!}</td>
                @else
                <td>لا يوجد مزود خدمة</td>
            @endif
            @if(isset($row->sub_services))
                <td>{{$row->sub_services->name_ar}}</td>
            @else
                <td>لا يوجد خدمة ثانوية </td>
            @endif

            @if(!empty($row->product))
            <td>{!! $row->product->name_ar !!}</td>
                @else
                <td> لا يوجد منتج </td>
            @endif
            <td>{{($row->status == 'new') ? 'جديد' : ($row->status == 'working' ? 'يتم العمل عليه': ($row->status == 'canceled' ? 'تم رفضه': 'تم بنجاح'))}}</td>

            <td>
                <div class="table-actions text-left">
                    <div class="table-actions text-left">
                        <a href="{{route('orders.show',$row->id)}}"><i class="ik ik-eye"></i></a>
                    </div>

                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
