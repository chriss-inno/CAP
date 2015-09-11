<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CAShareholders;
use App\CADirectors;
use App\FacilityStructure;
use App\FormStage;
use App\CurrentBankers;
use App\Covenants;
use App\PricingRationale;
use App\BusinessActivity;
use App\Environment;
use App\Swot_Analysis;
use App\ProposedSecurity;
use App\FinalRecommendations;
use App\FinancialAnalysis;
use App\Signator;
use App\AnnexureII;
use App\AnnexureI;

class CreditApp extends Model {

	//
    protected $table = 'credit_proposal';

    //Get shareholders
    public function shareholders()
    {
        return  $this::hasMany('App\CAShareholders','crp_id','id');
    }
    //Get directors
    public function directors()
    {
        return $this::hasMany('App\CADirectors','crp_id','id');
    }

    public function facilitystructure()
    {
        return $this::hasOne('App\FacilityStructure','crp_id','id');
    }

     //Get customer

    public function customer()
    {
        return $this::belongsTo('App\Customer','customer_id');
    }
    //Get stages
    public function formstage()
    {
        return $this::hasMany('App\FormStage','crp_id','id');
    }
    public function crSignatories()
    {
        return $this::hasMany('App\Signator','crp_id','id');
    }
    public function finalRecommendations()
    {
        return $this::hasMany('App\FinalRecommendations','crp_id','id');
    }

    public function accountprofile()
    {
        return $this::hasOne('App\AccountProfile','crp_id','id');
    }
    public function currentbankers()
    {
        return $this::hasMany('App\CurrentBankers','crp_id','id');
    }

    public function  accountperformance()
    {
        return $this::hasOne('App\AccountPerformance','crp_id','id');
    }
    public function  covenants()
    {
        return $this::hasOne('App\Covenants','crp_id','id');
    }
    public function  pricingrationale()
    {
        return $this::hasOne('App\PricingRationale','crp_id','id');
    }
    public function  businessactivity()
    {
        return $this::hasOne('App\BusinessActivity','crp_id','id');
    }
    public function  swotanalysis()
    {
        return $this::hasOne('App\Swot_Analysis','crp_id','id');
    }
    public function  proposedsecurity()
    {
        return $this::hasOne('App\ProposedSecurity','crp_id','id');
    }
    public function financialAnalysis()
    {
        return $this::hasOne('App\FinancialAnalysis','crp_id','id');
    }
    public function environment()
    {
        return $this::hasOne('App\Environment','crp_id','id');
    }
    public function creditRiskGrading()
    {
        return $this::hasOne('App\CreditRiskGrading','crp_id','id');
    }
    public function annexure_i()
    {
        return $this::hasOne('App\AnnexureI','crp_id','id');
    }
    public function annexure_ii()
    {
        return $this::hasOne('App\AnnexureII','crp_id','id');
    }
    public function dscr()
    {
        return $this::hasOne('App\DSCR','crp_id','id');
    }












}
