<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LiquidityDetail;

class Liquidity extends Model {

	//
    public function  detail()
    {
        return $this::hasMany('App\LiquidityDetail','liquidity_id','id');
    }
}
