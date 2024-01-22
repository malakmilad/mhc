<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sheet extends Model
{
    // use SoftDeletes;
    protected $table = 'sheets';
    //protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = ['created_at'];
    public function phones()
    {
        return $this->hasMany('App\Phone', 'sheet_id');

    } //end of phones

    public function customerservice()
    {
        return $this->hasMany('App\CustomerService', 'customer_id');

    } //end of customerservice
    public function diseaseservice()
    {
        return $this->hasMany('App\DiseaseCustomer', 'customer_id');

    } //end of customerservice

    public function userfun()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');

    } //end of userfun
    public function area()
    {
        return $this->belongsTo('App\Area', 'areaid', 'id');

    } //end of userfun
    public function social()
    {
        return $this->belongsTo('App\Socail', 'socailid', 'id');

    } //end of userfun
}
