<?php
namespace App\Http\Controllers\admin;
use App\Model\Goods;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\redis;
class NewssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $n_name=request()->n_name;
        $where=[];
        if($n_name){
            $where[]=['n_name', 'like', "%$n_name%"];
        }
//
//        $page=request()->page;
//        $data=redis::get('data_'.$page.'_'.$n_name);
//        $data=unserialize($data);
//        if(!$data) {
//           echo '走缓存';

            $pageSize = config('app.pageSize');
            $data = DB::table('newss')->where($where)->paginate($pageSize);
//            redis::setex('data_'.$page.'_'.$n_name,300,serialize($data));
//
//        }
        $query=request()->all();
        return view('admin.news.index',['data'=>$data,'query'=>$query]);

    }

    public function detail($id){
            $data=DB::table('newss')->find($id);
            redis::setnx('num_'.$id,1);
            redis::incr('num_'.$id);
            $num=redis::get('num'.$id);
        return view('admin.news.detail',['data'=>$data,'num'=>$num]);
    }

    public function create(){

        return view('admin.news.create.blade.php');
    }


    public function store(Request $request){
//        echo 111;die;
        $post=$request->except('_token');

//        dd($post);
        //判断单文件
        if($request->hasFile('n_file')){
            $post['n_file']=$this->img('n_file');
        }


        $res=DB::table('newss')->insert($post);
//        dd($res);
        if($res){
            echo "<script>alert('添加成功');location.href='/newss';</script>";
        }

    }





    //单双文件上传
    public function img($img){
        $photo = request()->file($img);
        if(is_array($photo)){
            $result=[];
            foreach($photo as $v){
                if($v->isValid()){
                    $result[]=$v->store('n_file');
                }
            }
            return $result;
        }else{
            if($photo->isValid()){
                $store_result = $photo->store('n_file');
                return $store_result;
            }
        }
        exit('未获取到上传文件或上传过程出错');
    }
}
