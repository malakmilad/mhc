<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    use SoftDeletes;
    protected $table = 'user_groups';
    protected $dates = ['deleted_at'];

    public function group()
    {
        return $this->belongsTo('App\Group','group_id','id');

    }//end of userfun
}
