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
<h3>留言展示页面</h3>
<h4>欢迎   <b style="color:red">{{session('admin.l_name')}}</b>   登录</h4>
<a href="{{url('message/create')}}">添加留言</a> &nbsp;&nbsp;&nbsp;<a href="{{'login/loginEdit'}}">退出登录</a>
<form>
    <input type="text" name="m_desc" placeholder="请输入留言关键字" value="{{$query['m_desc']??''}}">
    <input type="submit" value="搜索">
    当前页面浏览量<b style="color:red">{{$num}}</b>次
</form>
    <table border="1">
        <tr>
            <td>ID</td>
            <td>留言内容</td>
            <td>添加人</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        @if($data)
        @foreach($data as $v)
        <tr>
            <td>{{$v->m_id}}</td>
            <td>{{$v->m_desc}}</td>
            <td>{{$v->l_name}}</td>
            <td>{{date('Y-m-d h:i:s',$v->m_time)}}</td>
            <td><a href="{{url('message/del/'.$v->m_id)}}">删除</a>
                <a href="{{url('message/show/'.$v->m_id)}}">详情页</a></td>
        </tr>
            @endforeach
            @endif
    </table>
{{--{{$data->appends($query)->links()}}--}}
</body>
</html>