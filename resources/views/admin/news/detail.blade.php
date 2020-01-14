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
<h3>详情页</h3>
   <table border="1">
       <tr>
           <td>新闻名称</td>
           <td><input type="text"name="n_name" value="{{$data->n_name}}"></td>
       </tr>
       <tr>
           <td>新闻网址</td>
           <td><input type="text" name="n_url" value="{{$data->n_url}}"></td>
       </tr>
       <tr>
           <td>新闻介绍</td>
           <td><textarea name="n_desc" id="" cols="30" rows="10">{{$data->n_desc}}</textarea></td>
       </tr>
       <tr>
           <td>访问量</td>
           <td><input type="text" placeholder="{{$num}}"></td>
       </tr>
       <tr>
           <td><a href="{{url('/newss')}}">返回</a></td>
           <td></td>
       </tr>
   </table>

</body>
</html>
