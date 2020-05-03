<table id="data_table" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">الاسم بالعربية</th>
        <th class="sorting">الاسم بالانجليزية</th>
        <th class="sorting">الدولة</th>
        <th class="nosort">العمليات</th>
        <th class="nosort"></th><th ></th>
    </tr>
    </thead>
    <tbody>
    @foreach($cities  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name_ar}}</td>
            <td>{{$row->name_en}}</td>
            <td>{{$row->country->name_en}} / {{$row->country->name_ar}}</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('cities.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('cities.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
