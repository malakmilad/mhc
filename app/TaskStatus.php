<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskStatus extends Model
{
    use SoftDeletes;
    protected $table = 'task_status';
    protected $dates = ['deleted_at'];
}
