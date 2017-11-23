<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Mv_Sort extends Model
{
    use SoftDeletes,Notifiable;
    //
    protected $table='mv_sort';
    protected $primaryKey='id';
    protected $fillable=['name','sort_img'];

    public function movies()
    {
        return $this->hasMany('App\Model\Movies','id','sort_id');
    }
}
