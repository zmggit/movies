<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use SoftDeletes,Notifiable;
    protected $table='comment';
    protected $primaryKey= 'id';
    protected $fillable=['text','like','ip_id','movies_id'];

    public function movies()
    {
        return $this->belongsTo('App\Model\Movies','movies_id','id');
    }
    public function ip()
    {
        return $this->belongsToMany('App\Model\Ip','ip_movies','movies_id','ip_id');
    }

    public function commip()
    {
        return $this->belongsTo('App\Model\ip','ip_id','id');
    }

}
