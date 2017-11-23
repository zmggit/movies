<?php

namespace App\Http\Controllers\Web;

use App\Model\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    //
    public function search(Request $request)
    {
        $per_page=$request->get('per_page');
      $search=$request->get('search');
     $movies=Movies::with(['mv_sort'])->whereHas('mv_sort',function ($q) use ($search){
     $q->where('name', 'like', '%' . $search . '%');
     })->orWhere('describe', 'like', '%' . $search . '%')
         ->orWhere('title', 'like', '%' . $search . '%');
        if ($per_page==null){
            $per_page=8;
            return $movies->where('status','1')->paginate($per_page);
        }else{
            return $movies->where('status','1')->paginate($per_page);
        }
    }
}
