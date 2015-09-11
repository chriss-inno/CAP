<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SalesDetail;

class Sale extends Model {

	//
    public function  detail()
    {
        return $this::hasMany('App\SalesDetail','sale_id','id');
    }
}
