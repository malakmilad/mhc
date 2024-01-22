<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $table = 'users';
    protected $dates = ['deleted_at'];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function groups()
    {
        return $this->hasMany('App\UserGroup','user_id');

    }//end of permissions

    public function sheets()
    {
        return $this->hasMany('App\Sheet','user_id');

    }//end of sheets
}
