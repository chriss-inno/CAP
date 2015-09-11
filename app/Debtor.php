<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DebtorsDetail;

class Debtor extends Model {

	//
    public function  detail()
    {
        return $this::hasMany('App\DebtorsDetail','deditor_id','id');
    }
}
