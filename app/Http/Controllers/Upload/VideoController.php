<?php

namespace App\Http\Controllers\Upload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use YueCode\Cos\QCloudCos;
define('FFMPEG_PATH', '/usr/local/ffmpeg2/bin/ffmpeg -i "%s" 2>&1');

class VideoController extends Controller
{
    protected $file;

    function __construct($file)
    {
        $this->file = $file;
    }
    public function upload()
    {
        $file=$this->file;
        $vtime = exec("ffmpeg -i ".$file." 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");//总长度
        $ctime = date("Y-m-d H:i:s",filectime($file));//创建时间
        //$duration = explode(":",$time);
        // $duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);//转化为秒
        return array('vtime'=>$vtime,
            'ctime'=>$ctime
        );
    }
}
