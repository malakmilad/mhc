<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskType extends Model
{
    use SoftDeletes;
    protected $table = 'task_types';
    protected $dates = ['deleted_at'];
}
