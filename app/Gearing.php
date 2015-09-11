<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GearingDetail;

class Gearing extends Model {

	//
    public function  detail()
    {
        return $this::hasMany('App\GearingDetail','gearings_id','id');
    }

}
