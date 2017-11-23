<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([
        'namespace'=>'Admin'],function (){
    Route::post('login', 'AuthController@postLogin');
    //上传图片
    Route::post('api_upload', 'ApiUploadController@upload');
    //根据地址上传图片
    Route::post('src_upload', 'ApiUploadController@srcupload');
    //上传视频
    Route::post('movies_upload', 'ApiUploadController@movies');



    Route::group([
        'middleware'=>[
            'auth:api'
        ],],function(){

        Route::get('logout','AuthController@logout');
        Route::get('movies/{id}', 'MovieController@info');
        //修改状态
        Route::post('status/{id}', 'MovieController@status');


        //后台分类
            Route::post('mv_sort', 'SortMvController@store');
            //添加视频
            Route::post('movies', 'MovieController@store');

//视频分类
        Route::get('mv_sort', 'SortMvController@index');
        Route::post('mv_sort/{id}', 'SortMvController@destroy');
        Route::post('mv_sort/{id}/edit', 'SortMvController@update');

        //视频文章
        Route::get('movies', 'MovieController@index');
        Route::post('movies/{id}/edit', 'MovieController@update');
        Route::post('movies/{id}/delete', 'MovieController@destroy');

        //生成微信签名
        Route::get('signature', 'SignatureController@getSignPackage');

        //生成腾讯云签名
        Route::get('tenxunsignature', 'SignatureController@tenxun');
        //同步接受数据
        Route::post('tenxun', 'TenxunController@tenxun');



    });


});

Route::group([
    'namespace'=>'Web'],function (){
    Route::group([
        'middleware'=>[
            'auth:api'
        ],],function(){
        //首页
        Route::get('index', 'IndexController@index');
        //分类下的文章
        Route::get('sort_mv', 'SortIndexController@index');
        //收藏显示
        Route::get('collection','CollectionController@index');
        //收藏
        Route::post('collection/{id}','CollectionController@change');


        //全局搜索
        Route::get('search','SearchController@search');
        //相关视频文章
        Route::get('about/{id}','AboutController@about');
        //文章评论
        Route::post('comment/{id}','CommentController@comment');
        //统计用户评论
        Route::get('usercomment','CommentController@user');
        //具体文章的
        Route::get('comment_index/{id}','CommentController@index');
        //电赞
        Route::get('comment_like/{id}','CommentController@like');









    });


});



