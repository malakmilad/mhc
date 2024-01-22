<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servic extends Model
{
	use SoftDeletes;
    protected $table = 'servics';
    protected $dates = ['deleted_at'];
}
