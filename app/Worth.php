<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\WorthDetail;

class Worth extends Model {

	//
    public function  detail()
    {
        return $this::hasMany('App\WorthDetail','worth_id','id');
    }
}
