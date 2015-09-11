<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PricingRationaleDetails;

class PricingRationale extends Model {

    //
    protected $table = 'pricing_rationale';

    public function details()
    {
        return $this::hasMany('App\PricingRationaleDetails','pricing_rationale_id','id');
    }
}
