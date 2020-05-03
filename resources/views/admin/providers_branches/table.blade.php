<table id="" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">مزود الخدمة</th>
        <th class="nosort">الجوال</th>
        <th class="sorting">الدولة</th>
        <th class="nosort">المدينة</th>
        <th class="nosort">العنوان</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($providers_branches  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->provider->name_ar}}</td>
            <td>{{$row->mobile}}</td>
            <td>{{$row->country->name_ar}}</td>
            <td>{{$row->city->name_ar}}</td>
            <td>{{$row->address}}</td>
            <td><a href="{{route('branch_period_time.show',$row->id)}}" class="btn btn-primary"> اوقات العمل </a></td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('providers_branches.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('providers_branches.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
