<?php

namespace App\Http\Controllers\Web;

use App\Model\Ip;
use App\Model\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function index(Request $request)
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $ok=Ip::where('ip_address',$ip)->first();
        if ($ok){
            $per_page=$request->get('per_page');
            if ($per_page==null){
                $per_page=8;
                return     Movies::with(['mv_sort'])->paginate($per_page);
            }else{
                return    Movies::with(['mv_sort'])->paginate($per_page);
            }
        }else{
            Ip::create([
                'ip_address'=>$ip
            ]);
            $per_page=$request->get('per_page');
            if ($per_page==null){
                $per_page=8;
                return     Movies::with(['mv_sort'])->paginate($per_page);
            }else{
                return    Movies::with(['mv_sort'])->paginate($per_page);
            }

        }


    }
}
