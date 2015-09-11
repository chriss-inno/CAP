<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {

	//
    public function creditApp()
    {
        return $this::hasMany('App\CreditApp','customer_id','id');
    }
    public function Signatories()
    {
        return $this::hasMany('App\CustomerSignatory','customer_id','id');
    }
    public function accountprofile()
    {
        return $this::hasOne('App\AccountProfile','customer_id','id');
    }

    public function currentbankers()
    {
        return $this::hasMany('App\CurrentBankers','customer_id','id');
    }
    public function shareholders()
    {
        return  $this::hasMany('App\CAShareholders','customer_id','id');
    }

    //Get directors
    public function directors()
    {
        return $this::hasMany('App\CADirectors','customer_id','id');
    }

}
