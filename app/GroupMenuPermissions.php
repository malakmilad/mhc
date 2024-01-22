<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupMenuPermissions extends Model
{
    use SoftDeletes;
    protected $table = 'group_menu_permissions';
    protected $dates = ['deleted_at'];

    public function menus()
    {
        return $this->belongsTo('App\Menu','menu_id','id');

    }//end of permissions
}
