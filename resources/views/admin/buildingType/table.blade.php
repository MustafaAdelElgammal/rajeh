<table id="data_table" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">الاسم بالعربية</th>
        <th class="sorting">الاسم بالانجليزية</th>
        <th class="nosort">العمليات</th>
        <th></th>

    </tr>
    </thead>
    <tbody>
    @foreach($buildingType  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name_ar}}</td>
            <td>{{$row->name_en}}</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('buildingType.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('buildingType.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
