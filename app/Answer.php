<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;
    protected $table = 'answers';
    protected $dates = ['deleted_at'];

    public function customer()
    {
        return $this->belongsTo('App\Sheet', 'customer_id', 'id');
    }

    public function operation()
    {
        return $this->belongsTo('App\TimeTable', 'operation_id', 'id');
    }
    public function questions()
    {
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }
}
