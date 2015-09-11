<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountPerformance extends Model {

	//
    public function accountperformanceBank()
    {
        return $this::hasMany('App\AccountPerformanceBank','a_p_id','id');
    }

    public function accountperformanceTZS()
    {
        return $this::hasMany('App\AccountPerformanceTZS','a_p_id','id');
    }
    public function accountperformanceUSD()
    {
        return $this::hasMany('App\AccountPerformanceUSD','a_p_id','id');
    }



}
