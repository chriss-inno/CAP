<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\QualitativeAnalysis;
use App\QuantitativeAnalysis;

class CreditRiskGrading extends Model {

	//
    public function qanalysis()
    {
        return $this::hasMany('App\QualitativeAnalysis','crg_id','id');
    }
    public function qntanalysis()
    {
        return $this::hasMany('App\QuantitativeAnalysis','crg_id','id');
    }

}
