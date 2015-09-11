<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProposedSecurityDetailed;
class ProposedSecurity extends Model {

    //
    protected $table = 'proposed_security';

    public function details()
    {
        return $this::hasMany('App\ProposedSecurityDetailed','ps_id','id');
    }
}