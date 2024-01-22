<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    protected $table = 'groups';
    protected $dates = ['deleted_at'];

    public function permissions()
    {
        return $this->hasMany('App\GroupMenuPermissions','group_id');

    }//end of permissions
}
