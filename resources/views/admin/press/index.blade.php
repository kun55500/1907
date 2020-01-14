<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <script src="/static/admin/js/jquery.min.js"></script>
    <script src="/static/admin/js/bootstrap.min.js"></script>
    <script src="/static/admin/js/jquery.js"></script>
    <title>Document</title>
</head>
<body>
<form>
    <h1>新闻展示</h1>
    <input type="text"name="p_name"placeholder="新闻内容" value="{{$query['p_name']??''}}">
    <input type="submit" value="搜索">
</form>
<table border="1">
    <tr>
        <td>ID</td>
        <td>新闻内容</td>
        <td>添加人</td>
        <td>操作</td>
    </tr>
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
</table>
</body>
</html>

<script>
    $(document).on('click','.pagination a',function(){
        var url =$(this).attr('href');
        $.get(url,function(res){
            $('tbody').html(res);
        });
        return false;
    });
</script>
