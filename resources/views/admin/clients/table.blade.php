<table id="data_table" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">الصورة</th>
        <th class="sorting">العميل</th>
        <th class="nosort">الجوال</th>
        <th class="nosort">العنوان</th>
        <th></th><th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($clients  as $row)
        <tr>
            <td>{{$row->id}}
            <td>
                <a href="{{asset($row->image)}}" trarger="_blank" ><img src="{{asset($row->image)}}" class="table-user-thumb" alt="{{$row->name}}"></a>
            </td>
            <td>{{$row->name}}</td>
            <td>{{$row->mobile}}</td>
            <td>{{$row->address}}</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('clients.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('clients.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
