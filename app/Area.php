<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;
    protected $table = 'areas';
    public function Gov()
    {
        return $this->belongsTo('App\Area', 'parentid', 'id');
    }
    public function children()
    {
        return $this->hasMany('App\Area', 'parentid', 'id');
    }
    public function parent()
    {
        return $this->belongsTo('App\Area', 'id', 'parentid');
    // return $this->hasOne('App\Area','id', 'parentid');
    }
    protected $dates = ['deleted_at'];
}
