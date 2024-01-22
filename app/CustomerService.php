<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerService extends Model
{
    use SoftDeletes;
    protected $table = 'customer_services';
    protected $dates = ['deleted_at'];

    public function service()
    {
        return $this->belongsTo('App\Servic','service_id','id');

    }//end of service
}
