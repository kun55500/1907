<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Press;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class PressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p_name = request()->p_name??'';
        $page = request()->page??'';

//        $post=Cache::get('post_'.$p_name.'_'.$page);
        $post = Redis::get('post_'.$p_name.'_'.$page);
        if (!$post) {
            echo '走数据库';
        }
            $where = [];
            if ($p_name) {
                $where[] = ['p_name', 'like', "%$p_name%"];
            }

            $pageSize = config('app.pageSize');
            $post = Press::where($where)->paginate($pageSize);
//        Cache::put(['post_'.$p_name.'_'.$page=>$post],300);
            $post = serialize($post);
            Redis::setex('post_'.$p_name.'_'.$page,5,$post);
            $post=unserialize($post);






        $query=request()->all();
            if(request()->ajax()){
        return view('admin.press.ajaxindex',['post'=>$post,'query'=>$query]);
    }
        return view('admin.press.index',['post'=>$post,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
