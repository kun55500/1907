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
<form action="{{url('message/store')}}" method="post">
    @csrf
    <h3>留言添加</h3>
    <table>
        <tr>
            <td>留言</td>
            <td><textarea name="m_desc" id="" cols="20" rows="5"></textarea>
                <b style="color:red">{{$errors->first('m_desc')}}</b>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="添加"></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
</html>