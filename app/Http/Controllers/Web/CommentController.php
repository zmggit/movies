<?php

namespace App\Http\Controllers\Web;

use App\Model\Comment;
use App\Model\Ip;
use App\Model\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //
    public function comment(Request $request,$id)
    {
      $open_id=$request->get('open_id');
     $text=$request->get('text');
     $first=Ip::where('open_id',$open_id)->first();
     $fid=$first->id;
     if ($first){
         $resout=Comment::create([
             'text'=>$text,
             'movies_id'=>$id,
             'ip_id'=>$fid
         ]);
         if ($resout) {
             return $this->jsonSuccess();
         } else {
             return $this->jsonResponse('1', '评论失败');
         }
     }else{
         $ipre=Ip::create([
             'open_id'=>$open_id,
         ]);
         $idr=$ipre->id;
         $resout=Comment::create([
             'text'=>$text,
             'movies_id'=>$id,
             'ip_id'=>$idr
         ]);
         if (!empty($resoult)) {
             return $this->jsonSuccess();
         } else {
             return $this->jsonResponse('1', '评论失败');
         }

     }
    }

    public function index($id,Request $request)
    {
        return Movies::where('id',$id)->with('comment')->paginate(8);
    }

    public function user(Request $request)
    {
        $open_id=$request->get('opne_id');
        $id=Ip::where('open_id',$open_id)->first()->id;
        return Ip::where('id',$id)->with('comment')->paginate(8);
    }

    public function like(Request $request,$id)
    {
       $comment= Comment::where('id',$id)->first();
       $comment->like=$comment->like+1;
       $resoult=$comment->save();
        if ($resoult) {
            return $this->jsonSuccess();
        } else {
            return $this->jsonResponse('1', '点赞失败');
        }

    }
}
