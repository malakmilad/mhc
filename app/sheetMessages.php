<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sheetMessages extends Model
{
    use SoftDeletes;
    protected $table = 'sheet_message';
    protected $dates = ['deleted_at'];
}
