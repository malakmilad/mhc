<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivingPermissions extends Model
{
  protected $table="receiving_permissions";

    public function VarAsset()
    {
        return $this->belongsTo('App\VarAssets','var_asset_id','id');
    }
    public function employee()
    {
        return $this->belongsTo('App\User','created_by','id');
    }
  
}
