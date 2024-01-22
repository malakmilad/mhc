<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = 'menus';
    protected $dates = ['deleted_at'];

    public function menu()
    {
        return $this->belongsTo('App\Menu','parent_id','id');

    }//end of userfun

    public function menus()
    {
        return $this->hasMany('App\Menu','parent_id');

    }//end of menus
}
