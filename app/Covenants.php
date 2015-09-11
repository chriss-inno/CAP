<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CovenantDetails;

class Covenants extends Model {

    //
    protected $table = 'covenants';

    public function pricing()
    {
        return $this::hasMany('App\CovenantDetails','covenants_id','id');
    }
}
