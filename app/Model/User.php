<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'password','api_token',
    ];
    protected $primaryKey='id';
    protected $table='users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function login()
    {
        $name=$this->getAttribute('name');
        $user=User::where('name',$name)->get()->toArray();
        $user_api_token= $user['0']['api_token'];

        if ($user_api_token!=null){
            $this->update([
               'api_token'=>$user_api_token,
            ]);
            return $user_api_token;
        }else{

        $api_token=md5($this->getAttribute('id') . '_' . time() .rand(0,9999));
        $this->update([
           'api_token'=>$api_token,
        ]);
        return $api_token;
        }
    }

    public function logout()
    {
        return $this->update([
            'api_token'=>null,
        ]);
    }

    public function checkPassword($password)
    {
     return Hash::check($password,$this->getAttribute('password'));
    }

    public static function findByname($name)
    {
        return User::where('name',$name)->first();
    }
}
