<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Login;
class MessageLogin extends Controller
{
    public function login(){
        return view('admin.message.login');
    }

    public function LoginDo(){
        $post=request()->except('_token');
//        dd($post);
        $data=Login::where($post)->first();
        if ($data){
            session(['admin'=>$data]);
            request()->session()->save();
            echo "<script>alert('登录成功');location.href='/message';</script>";
        }else{
            echo "<script>alert('账号或密码错误');location.href='/login';</script>";
        }
    }

    public  function loginEdit(){
        $data=session('admin');
        if($data){
            session(['admin'=>null]);
            echo "<script>alert('退出成功');location.href='/login';</script>";
        }
    }
}
