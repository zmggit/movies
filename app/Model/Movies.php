<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Movies extends Model
{
    //
    use SoftDeletes,Notifiable;
    protected $table='movies';
    protected $primaryKey= 'id';
    protected $fillable=['title','weight','filed_id','collection_status','status','time','mv_url','describe','collection','sort_id','wei_status','wei_id'];

    public function mv_sort()
    {
        return $this->belongsTo('App\Model\Mv_Sort','sort_id','id');
    }

    public function ip()
    {
        return $this->belongsToMany('App\Model\Ip','ip_movies','movies_id','ip_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Model\Comment','movies_id','id');
    }




}
