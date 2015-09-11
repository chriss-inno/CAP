<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DSCRDetail;

class DSCR extends Model {

	//
    protected $table ='d_s_c_rs';

    public function  detail()
    {
        return $this::hasMany('App\DSCRDetail','ds_id','id');
    }
}
