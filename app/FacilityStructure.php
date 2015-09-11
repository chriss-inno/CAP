<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FacilityStructureLimits;
use App\FacilityStructureGroup;
use App\FinalRecommendations;

class FacilityStructure extends Model {

    //
    protected $table = 'facility_structure';

    public function facilitylimits()
    {
        return $this::hasMany('App\FacilityStructureLimits','fs_id','id');
    }
    public function facilitygroups()
    {
        return $this::hasMany('App\FacilityStructureGroup','fs_id','id');
    }
    public function finalrecommendations()
    {
        return $this::hasMany('App\FinalRecommendations','fs_id','id');
    }
}