<?php

namespace App\Http\Controllers\Web;

use App\Model\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SortIndexController extends Controller
{
    //
    public function index(Request $request)
    {
        $per_page=$request->get('per_page');
        $sort_id=$request->get('sort_id');
        $movies=Movies::with(['mv_sort']);
        if ($sort_id){
            $movies->where('sort_id',$sort_id);
        }
        if ($per_page==null){
            $per_page=8;
            return $movies->paginate($per_page);
        }else{
            return $movies->paginate($per_page);
        }

    }
}
