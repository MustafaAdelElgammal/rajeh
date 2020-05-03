<table id="data_table" class="table">
    <thead>
    <tr>
        <th class="sorting_asc">#</th>
        <th class="sorting">الاسم</th>
        <th class="sorting">القيمة</th>
        <th class="nosort">&nbsp; العمليات</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($settings  as $setting)
        <tr>
            <td>{{$setting->id}}</td>
            <td>{{$setting->name}}</td>
            <td>{{$setting->value}}</td>
            <td>
                <div class="table-actions text-left">
                    <a href="{{route('settings.edit',$setting->id)}}"><i class="ik ik-edit-2"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

