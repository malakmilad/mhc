<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sheetGroups extends Model
{
    use SoftDeletes;
    protected $table = 'sheet_groups';
    protected $dates = ['deleted_at'];
}
