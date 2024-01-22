<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socail extends Model
{
    use SoftDeletes;
    protected $table = 'socails';
    protected $dates = ['deleted_at'];
}
