<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Upload\AllUploadController;
use App\Http\Controllers\Upload\UploadController;
use App\Http\Controllers\Upload\VideoController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use YueCode\Cos\QCloudCos;

class ApiUploadController extends Controller
{
    public function upload(Request $request)
    {
        $api_token=$request->get('api_token');
            $file=$request->file('file');
            $scaling=$request->get('scaling');
            $uploadresoult=new UploadController($file,$scaling);
            $url=$uploadresoult->upload();
            return $url;
    }

    public function srcupload(Request $request)
    {
     $src=$request->get('src');
     $src=new AllUploadController($src);
     return $src->allupload();

    }

    public function movies(Request $request)
    {
        $files=$request->file('file');
        $vi=new VideoController($files);
 return $vi->upload();
//        $bucket = "photo";
//        $folder = "test";
//        $srcPath = $files->getRealPath();
//        $ClientOriginalName = time() . rand(10000, 9999999) . '.' . $files->getClientOriginalExtension();
//        $dstPath = "$folder/$ClientOriginalName";
//        $upload = QCloudCos::upload($bucket,$srcPath,$dstPath);
//        $upload_json=json_decode($upload);
//        $data=$upload_json->data;
//        if ($upload_json->code==0){
//            return [
//                'data'=>$data->source_url,
//                'ok'=>'true'
//            ];
//        }else{
//            return [
//                'ok'=>'false'
//            ];
//        }
    }
}
