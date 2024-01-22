<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GivingPermissions extends Model
{
  protected $table="giving_permissions";
    public function VarAsset()
    {
        return $this->belongsTo('App\VarAssets','var_asset_id','id');
    }
    public function employee()
    {
        return $this->belongsTo('App\User','created_by','id');
    }
  
}
