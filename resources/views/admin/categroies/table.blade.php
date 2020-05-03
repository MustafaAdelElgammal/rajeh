<table id="data_table" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="sorting">الصورة</th>
        <th class="nosort">الاسم بالعربية</th>
        <th class="sorting">الاسم بالانجليزية</th>
        <th class="sorting">التصنيف</th>
        <th class="nosort">العمليات</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($categroies  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td><a href="{{asset($row->image)}}" trarger="_blank" ><img src="{{asset($row->image)}}" class="table-user-thumb" alt="{{$row->name}}"></a></td>
            <td>{{$row->name_ar}}</td>
            <td>{{$row->name_en}}</td>
            @if($row->is_featured == 1)
                <td>مميز</td>
            @else
                <td>غير مميز</td>
            @endif

            <td>
                <div class="table-actions text-left">
                    <a href="{{route('categroies.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('categroies.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
