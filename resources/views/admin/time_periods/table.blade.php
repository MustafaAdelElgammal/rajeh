
<table id="" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="nosort">من</th>
        <th class="nosort">الى</th>
        <th class="nosort">مزود الخدمة</th>
        <th class="nosort">المدينة</th>

        <th class="nosort"> العمليات </th>
    </tr>
    </thead>
    <tbody>

    @foreach($time_periods as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{!! $row->from !!}</td>
            <td>{!! $row->to !!}</td>
            <td>{{$row->providers->name_ar}}</td>
            <td>{{$row->branch->city->name_ar}}</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('branch_period_time.edit',$row->id)}}"><i class="ik ik-edit-2"></i></a>
                    <a onclick="Delete({{'deleteForm'.$row->id}})"><i class="ik ik-trash-2"></i></a>
                    <form id="deleteForm{{$row->id}}" action="{{route('branch_period_time.destroy',$row->id)}}"
                          method="post">
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
