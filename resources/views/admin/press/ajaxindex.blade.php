<table>
@if($post)
    @foreach($post as $v)
        <tr>
            <td>{{$v->p_id}}</td>
            <td>{{$v->p_name}}</td>
            <td>{{$v->p_man}}</td>
            <td><a href="javascript:;">删除</a></td>
        </tr>
    @endforeach
@endif
<tr>
    <td colspan="4"> {{$post->appends($query)->links()}}</td>
</tr>
<table>
