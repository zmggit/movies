<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Ip extends Model
{
    use SoftDeletes,Notifiable;
    protected $table='ip';
    protected $primaryKey= 'id';
    protected $fillable=['open_id'];

    public function movies()
    {
        return $this->belongsToMany('App\Model\Movies','ip_movies','ip_id','movies_id');
    }
    public function comment()
    {
        return $this->hasMany('App\Model\Comment','ip_id','id');
    }
}
