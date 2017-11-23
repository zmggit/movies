<?php

namespace App\Http\Controllers\Admin;

use App\Model\Movies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TenxunController extends Controller
{
        public function tenxun(Request $request)
    {
        $all=$request->all();
        $eventType=$all['eventType'];
        if ($eventType=='ProcedureStateChanged'){
            $size=$all['data']['metaData']['size'];
            $movies_size=number_format($size/1024/1024, 2);
            $time=$all['data']['metaData']['duration'];
            $fileId=$size=$all['data']['fileId'];
            $movies_url=$size=$all['data']['processTaskList'][0]['output']['url'];
            $reoult=Movies::where('filed_id',$fileId)->update([
                'time'=>$time,
                'mv_url'=>$movies_url,
                'status'=>1
            ]);
        }
        Log::info($all);
    }
}
