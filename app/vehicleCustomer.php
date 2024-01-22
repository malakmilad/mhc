<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleCustomer extends Model
{
    // use SoftDeletes;
    protected $table = 'vehicle_services';
//  protected $dates = ['deleted_at'];
}
