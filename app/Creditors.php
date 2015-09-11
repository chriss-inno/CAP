<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CreditorsDetail;

class Creditors extends Model {

	//
    public function  detail()
    {
        return $this::hasMany('App\CreditorsDetail','creditor_id','id');
    }
}
