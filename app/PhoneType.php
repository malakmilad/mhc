<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneType extends Model
{
	use SoftDeletes;
    protected $table = 'phone_types';
    protected $dates = ['deleted_at'];
}
