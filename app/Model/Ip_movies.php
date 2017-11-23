<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Ip_movies extends Model
{
    use SoftDeletes,Notifiable;
    protected $table='ip_movies';
    protected $primarKey='id';
    protected $fillable=['ip_id','movies_id','create_at','update_at'];
}
