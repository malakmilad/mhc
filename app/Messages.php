<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Messages extends Model
{
    use SoftDeletes;
    protected $table = 'messages';
    protected $dates = ['deleted_at'];
}
