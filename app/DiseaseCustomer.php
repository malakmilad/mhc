<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiseaseCustomer extends Model
{
    use SoftDeletes;
    protected $table = 'disease_services';
    protected $dates = ['deleted_at'];
}
