<?php

namespace App\Http\Controllers\Web;

use App\Model\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    //
    public function about(Request $request,$id)
    {  $per_page=$request->get('per_page');
      $sort_id=$request->get('sort_id');
    $movies=Movies::with(['mv_sort'])->whereHas('mv_sort',function ($q) use ($sort_id){
$q->where('mv_sort.id',$sort_id);
      });
        if ($per_page==null){
            $per_page=8;
            return $movies->where('status','1')->where('id','!=',$id)->paginate($per_page);
        }else{
            return $movies->where('status','1')->Where('id','!=',$id)->paginate($per_page);
        }
    }
}
