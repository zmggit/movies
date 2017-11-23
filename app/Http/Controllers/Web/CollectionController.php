<?php

namespace App\Http\Controllers\Web;

use App\Model\Ip;
use App\Model\Ip_movies;
use App\Model\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    //
    public function index(Request $request)
    {
        $open_id=$request->get('open_id');
     return Movies::with(['ip','mv_sort'])->whereHas('ip',function ($q) use ($open_id){
         $q->where('open_id',$open_id);
     })->paginate(8);


    }

    public function change(Request $request,$id)
    {
        $open_id=$request->get('open_id');
        $ip=Ip::where('open_id',$open_id)->first();

        $pan=0;
        $choice=$request->get('choice');
        if ($choice==0){
           //收藏
            if ($ip){
                $wei_ip=$ip->id;
                $resoult=Movies::where('id',$id)->update([
                    'wei_id'=>$wei_ip,
                    'wei_status'=>1
                ]);
                if ($resoult){
                    $mv=$ip->movies()->get()->toArray();
                    foreach ($mv as $k=>$y){
                        if ($y['id']==$id){
                            $pan=1;
                        }
                    }
                    if ($pan==1){
                        if (!empty($resoult)) {
                            return $this->jsonSuccess();
                        } else {

                            return $this->jsonResponse('1', '收藏数增加失败');
                        }
                    }else{
                        Ip::find($wei_ip)->movies()->attach($id,
                            ['created_at' => date('Y-m-d H-i-s'), 'updated_at' => date('Y-m-d H-i-s')]);
                        if (!empty($resoult)) {
                            return $this->jsonSuccess();
                        } else {

                            return $this->jsonResponse('1', '收藏数增加失败');
                        }
                    }


                }else{
                    return $this->jsonResponse('1', '收藏失败');
                }

            }else{
                $ip_resoult=Ip::create([
                    'open_id'=>$open_id,
                ]);
                $wei_ip=$ip_resoult->id;
                $resoult=Movies::where('id',$id)->update([
                    'wei_id'=>$wei_ip,
                    'wei_status'=>1
                ]);
                if ($resoult){
                    $col=Movies::where('id',$id)->first();
                    $col->collection=$col->collection+1;
                    $col->save();
                    if (!empty($resoult)) {
                        Ip::find($wei_ip)->movies()->attach($id,
                            ['created_at' => date('Y-m-d H-i-s'), 'updated_at' => date('Y-m-d H-i-s')]);
                        return $this->jsonSuccess();
                    } else {
                        return $this->jsonResponse('1', '收藏数增加失败');
                    }
                }else{
                    return $this->jsonResponse('1', '收藏失败');
                }
            }

        }else if ($choice==1){
            $resoult=Movies::where('id',$id)->update([
                'wei_id'=>null,
                'wei_status'=>0
            ]);

            if ($resoult){
                $col=Movies::where('id',$id)->first();
                $col->collection=$col->collection-1;
                $col->save();
                $ip=Ip::where('open_id',$open_id)->first();
                $idd=$ip->id;
                Ip::find($idd)->movies()->detach($id,
                    ['created_at' => date('Y-m-d H-i-s'), 'updated_at' => date('Y-m-d H-i-s')]);

                if (!empty($resoult)) {
                    return $this->jsonSuccess();
                } else {
                    return $this->jsonResponse('1', '减少数增加失败');
                }
            }else{
                return $this->jsonResponse('1', '取消收藏失败');
            }


        }


    }

}
