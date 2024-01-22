<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Opportunity extends Model
{
    use SoftDeletes;
    protected $table = 'opportunitys';
    protected $dates = ['deleted_at'];
}
