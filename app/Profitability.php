<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProfitabilityDetail;

class Profitability extends Model {

	//
    public function  detail()
    {
        return $this::hasMany('App\ProfitabilityDetail','pf_id','id');
    }
}
