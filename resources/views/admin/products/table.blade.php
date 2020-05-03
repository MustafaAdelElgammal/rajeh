<table id="" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">الصورة</th>
        <th class="nosort">الاسم بالعربية</th>
        <th class="sorting">الاسم بالانجليزية</th>
        <th class="nosort">القسم</th>
        <th class="nosort">التصنيف</th>
        <th>العمليات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>
                <a href="{{asset($row->image)}}" trarger="_blank" ><img src="{{asset($row->image)}}" class="table-user-thumb" alt="{{$row->name}}"></a>
            </td>
            <td>{{$row->name_ar}}</td>
            <td>{{$row->name_en}}</td>
            @if(isset($row->sub_service))
            <td>{{$row->sub_service->name_ar}}</td>
            @else
                <td>لا يوجد قسم </td>
            @endif
            <td>@if($row->is_featured === 1) مميز @else غير مميز @endif</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('products.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('products.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
