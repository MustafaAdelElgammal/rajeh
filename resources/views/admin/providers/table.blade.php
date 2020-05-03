<table id="" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="sorting_asc">الصورة</th>
        <th class="nosort">الاسم بالعربية</th>
        <th class="sorting">الاسم بالانجليزية</th>
        <th class="nosort">رقم جوال</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($providers  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>
                <a href="{{asset($row->image)}}" trarger="_blank" ><img src="{{asset($row->image)}}" class="table-user-thumb" alt="{{$row->name_ar}}"></a>
            </td>
            <td>{{$row->name_ar}}</td>
            <td>{{$row->name_en}}</td>
            <td>{{$row->mobile}}</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('providers.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('providers.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
