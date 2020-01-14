<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <table border="1"><a href="{{url('create.blade.php')}}">添加视图</a>
        <tr>
            <td>id</td>
            <td>新闻标题</td>
            <td>新闻网址</td>
            <td>新闻内容</td>
            <td>操作</td>
        </tr>
        @if($data)
        @foreach($data as $v)
        <tr>
            <td>{{$v->n_id}}</td>
            <td>{{$v->n_name}}</td>
            <td>{{$v->n_url}}</td>
            <td>{{$v->n_desc}}</td>
            <td><a href="{{url('newss/detail/'.$v->n_id)}}">详情</a></td>
        </tr>
            @endforeach
            @endif
    </table>
    {{$data->links()}}

</body>
</html>
