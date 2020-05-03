<table id="data_table" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="sorting">الصورة</th>
        <th class="sorting">اسم الباقة</th>
        <th class="nosort">السعر</th>
        <th class="nosort">المدة</th>
        <th class="nosort">نوع الباقة</th>
        <th class="nosort">العمليات</th>
        <th></th><th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($packages  as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>
                <a href="{{asset($row->image)}}" trarger="_blank">
                    <img src="{{asset($row->image)}}" class="table-user-thumb" alt="{{$row->name_ar}}">
                </a>
            </td>
            <td>{{$row->name_ar}}</td>
            <td>{{$row->price}}</td>
            <td>{{$row->period}}</td>
            @if($row->type == 'year')
            <td>سنوية</td>
                @elseif($row->type == 'day')
                <td>يومية</td>
            @elseif($row->type == 'week')
                <td>اسبوعية</td>
            @elseif($row->type == 'month')
                <td>شهرية</td>
            @endif
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('packages.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})" ><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('packages.destroy',$row->id)}}" method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
