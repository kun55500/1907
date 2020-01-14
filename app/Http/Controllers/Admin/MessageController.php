<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Message;
use Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $m_desc=request()->m_desc;
        $where=[];
        if ($m_desc){
            $where[]=['m_desc','like',"%$m_desc%"];
        }
//        $data=Cache::get('data_'.$m_desc);
        $data=Redis::get('data_'.$m_desc);
        if (!$data){
            echo '数据库';
        }
//        $pageSize=config('app.pageSize');
        $data=Message::Leftjoin('login','message.l_id','=','login.l_id')
            ->where($where)
            ->orderBy('m_id','desc')
            ->get();
//            Cache::put(['data_'.$m_desc=>$data],60);
        $data=serialize($data);
        Redis::setex('data_'.$m_desc,60,$data);
        $data=unserialize($data);

        $query=request()->all();
        Redis::setnx('num',0);
        Redis::incr('num');
//        Cache::flush();
        $num=Redis::get('num');
        return view('admin.message.index',['data'=>$data,'query'=>$query,'num'=>$num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=$request->except('_token');
//        dd($post);
        $post['m_time']=time();
//        $post['m_time']=strtotime("-29minute",time());
        $post['l_id']=session('admin')->l_id;

        $validator = Validator::make($post, [
            'm_desc' => 'required',
        ],[
            'm_desc.required' => '留言不能为空',
        ]);
        if ($validator->fails()) {
            return redirect('message/create')
                ->withErrors($validator)
                ->withInput();
        }

        $res=Message::insert($post);
        if ($res){
            echo "<script>alert('添加成功');location.href='/message';</script>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=Message::where('m_id',$id)->get();
        Redis::setnx('num'.$id,0);
        Redis::incr('num'.$id);
        $num=Redis::get('num'.$id);
//        Cache::set('num',0);
//        Cache::increment('num'.$id);
//        $num=Cache::get('num'.$id);
        return view('admin.message.show',['num'=>$num,'data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Message::where('m_id',$id)->first();

        if(session('admin')->l_id==$data['l_id']){
            $start =$data['m_time'];
            $end = strtotime("+30minute", $data['m_time']);
            $now = time();
            if($now >=$start && $now<=$end){
                $date=Message::destroy($id);
                if($date) {
                    echo "<script>alert('删除成功');location.href='/message';</script>";
                }
            }else{
                echo "<script>alert('添加超过三十分钟,不能删除!');location.href='/message';</script>";
            }
        }else{
            echo "<script>alert('只能删除自己的留言哦!');location.href='/message';</script>";
        }
    }




}
