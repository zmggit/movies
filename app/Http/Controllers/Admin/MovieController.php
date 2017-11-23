<?php

namespace App\Http\Controllers\Admin;

use App\Model\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function info(Request $request,$id)
    {
        return Movies::where('id',$id)->with(['mv_sort'])->first();
    }

    public function webinfo(Request $request,$id)
    {
        $movies=Movies::where('id',$id)->with('mv_sort')->first();
        return $movies;
    }

    public function status(Request $request,$id)
    {
        $status=$request->get('status');
        $resoult=Movies::where('id',$id)->update([
            'status'=>$status
        ]);
        if (!empty($resoult)) {
            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '修改状态失败');
        }
    }

    public function index(Request $request)
    {
        $sort_id=$request->get('sort_id');
        $status=$request->get('status');
        $per_page=$request->get('per_page');
        $weight=$request->get('weight');
        $created_at=$request->get('created_at');
        $movies=Movies::with(['mv_sort']);
        if ($sort_id){
            $movies->where('sort_id',$sort_id);
        }
        if ($weight!=null){
            if ($weight==0){
                $movies->orderby('weight','desc');
            }
            if ($weight==1){
                $movies->orderby('weight','asc');
            }
        }
        if ($created_at!=null){
            if ($created_at==0){
                $movies->orderby('created_at','desc');
            }
            if ($created_at==1){
                $movies->orderby('created_at','asc');
            }
        }
        if ($per_page==null){
            $per_page=8;
            return $movies->paginate($per_page);
        }else{
            return $movies->paginate($per_page);
        }

    }

    public function store(Request $request)
    {
        $title=$request->get('title');
        $weight=$request->get('weight');
        $sort_id=$request->get('sort_id');
        $filed_id=$request->get('filed_id');
        $describe=$request->get('describe');
        $movies_url=$request->get('movies_url');
        $time=$request->get('time');
        $resoult=Movies::create([
            'title'=>$title,
            'weight'=>$weight,
            'sort_id'=>$sort_id,
            'filed_id'=>$filed_id,
            'describe'=>$describe,
            'mv_url'=>$movies_url,
            'time'=>$time
        ]);
            if (!empty($resoult)) {
                return $this->jsonSuccess();
            } else {
                return $this->jsonResponse('1', '添加失败');
            }
        }


    public function update(Request $request,$id)
    {
        $title=$request->get('title');
        $weight=$request->get('weight');
        $sort_id=$request->get('sort_id');
        $filed_id=$request->get('filed_id');
        $describe=$request->get('describe');
        $movies_url=$request->get('movies_url');
        $time=$request->get('time');

        $resoult=Movies::where('id',$id)->update([
            'title'=>$title,
            'weight'=>$weight,
            'sort_id'=>$sort_id,
            'filed_id'=>$filed_id,
            'describe'=>$describe,
            'mv_url'=>$movies_url,
            'time'=>$time
        ]);
        if (!empty($resoult)) {
            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '修改失败');
        }
    }

    public function destroy(Request $request,$id)
    {
        $about = Movies::destroy($id);
        if ($about) {

            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '删除失败');
        }
    }
}
