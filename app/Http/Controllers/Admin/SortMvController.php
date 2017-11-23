<?php

namespace App\Http\Controllers\Admin;

use App\Model\Mv_Sort;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SortMvController extends Controller
{
    //
    public function index()
    {
        return Mv_Sort::paginate(8);
    }
    //post
    public function store(Request $request)
    {
        $name=$request->get('name');
        $sort_img=$request->get('sort_img');
        $sort_resour=Mv_Sort::create([
                'name'=>$name,
                'sort_img'=>$sort_img
            ]
        );
        if ($sort_resour){
            return $this->jsonSuccess();
        }else{
            return $this->jsonResponse('1', '添加失败');
        }
    }
    //delete
    public function destroy($id)
    {
        $resoult=Mv_Sort::find($id)->delete();
        if ($resoult){
            return $this->jsonSuccess();
        }else{
            return $this->jsonResponse('1', '删除失败');
        }
    }

    public function update(Request $request,$id)
    {
        $name=$request->get('name');
        $sort_img=$request->get('sort_img');
        $sort_report=Mv_Sort::where('id',$id)->update([
            'name'=>$name,
            'sort_img'=>$sort_img
        ]);
        if ($sort_report){
            return $this->jsonSuccess();
        }else{
            return $this->jsonResponse('1', '修改失败');
        }
    }


}
