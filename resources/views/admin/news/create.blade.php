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
<h3>添加页</h3>
<form action="{{url('newss/store')}}" method="post" enctype="multipart/form-data">
    @csrf
   <table border="1">
       <tr>
           <td>新闻名称</td>
           <td><input type="text"name="n_name"></td>
       </tr>
       <tr>
           <td>新闻网址</td>
           <td><input type="text" name="n_url"></td>
       </tr>
       <tr>
           <td>新闻介绍</td>
           <td><textarea name="n_desc" id="" cols="30" rows="10"></textarea></td>
       </tr>
       <tr>
           <td>图片</td>
           <td><input type="file"name="n_file"></td>
       </tr>
       <tr>
           <td><input type="submit" value="添加"></td>
           <td></td>
       </tr>
   </table>
</form>
</body>
</html>
