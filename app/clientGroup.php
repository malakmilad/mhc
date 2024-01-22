<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class clientGroup extends Model
{
    use SoftDeletes;
    protected $table = 'client_group';
    protected $dates = ['deleted_at'];
}
