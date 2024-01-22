<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activite extends Model
{
    use SoftDeletes;
    protected $table = 'activites';
    protected $dates = ['deleted_at'];
}
