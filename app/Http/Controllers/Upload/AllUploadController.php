<?php

namespace App\Http\Controllers\Upload;

use App\Http\Controllers\Upload\UploadController;
use App\Model\New_Activities;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Clientl;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Storage;
use YueCode\Cos\QCloudCos;
use App\Http\Controllers\Controller;

class AllUploadController extends Controller
{
    protected $src;
    function __construct($src)
    {
        $this->src=$src;
    }


    public function allupload()
    {
        $bucket = "photo";
        $folder = "test";
                $resoult=explode('.',$this->src);
        $ClientOriginalExtension=end($resoult);
                $ClientOriginalName = time() . rand(10000, 9999999) . '.' . $ClientOriginalExtension;
      $file='photo/'.$ClientOriginalName;
        $client=new Client(['verify' => false]);
        $client->get($this->src,['save_to'=> public_path($file)]);
        $dstPath = "$folder/$ClientOriginalName";
        $src='photo/'.$ClientOriginalName;
        $upload = QCloudCos::upload($bucket,$src,$dstPath);
        unlink($src);
        $upload_json=json_decode($upload);
        $data=$upload_json->data;
        if ($upload_json->code==0){
            return [
                'data'=>$data->source_url,
                'ok'=>'true'
            ];
        }else{
            return [
                'ok'=>'false'
            ];
        }

}
}
