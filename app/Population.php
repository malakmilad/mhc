<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Population extends Model
{
    use SoftDeletes;
    protected $table = 'populations';
    protected $dates = ['deleted_at'];
}
