<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Housing extends Model
{
    use SoftDeletes;
    protected $table = 'housing_companies';
    protected $dates = ['deleted_at'];
}
