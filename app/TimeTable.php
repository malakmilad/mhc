<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TimeTable extends Model
{
    // use SoftDeletes;
    protected $table = 'time_tables';
    // protected $dates = ['deleted_at'];

    public function customer()
    {
        return $this->belongsTo('App\Sheet', 'sheet_id', 'id');

    } //end of customer

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');

    } //end of user
    public function Gov()
    {
        return $this->belongsTo('App\Area', 'parentid', 'id');
    }


}
