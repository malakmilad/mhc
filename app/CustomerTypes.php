<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerTypes extends Model
{
    use SoftDeletes;
    protected $table = 'customer_types';
    protected $dates = ['deleted_at'];
}
