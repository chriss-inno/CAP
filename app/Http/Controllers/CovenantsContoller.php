<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CovenantsRequest;
use App\Covenants;
use App\PricingRationale;
use App\CovenantDetails;
use App\PricingRationaleDetails;
use App\FormStage;
use App\CreditApp;
use Illuminate\Support\Facades\Auth;
use App\Audit;

class CovenantsContoller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		//
        return view('caproposal.Covenants',compact('id'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CovenantsRequest $request)
	{
		//
        if( $request->apprequest ==0) //create new profile
        {
            $co = new Covenants;
            $co->appraisal_fee_1 = $request->appraisal_fee_1;
            $co->appraisal_fee_2 = $request->appraisal_fee_2;
            $co->appraisal_fee_3 = $request->appraisal_fee_3;
            $co->disbursal = $request->disbursal;
            $co->crp_id = $request->crp_id;
            $co->save();
            //Form  stage
            $completed = 50;

            //Insert Convernant details
            $pricing = $request->pricing;
            $type_nonfunded = $request->type_nonfunded;
            $fund_type = $request->fund_type;
            $facility = $request->facility;
            $spread = $request->spread;
            $effective_rate = $request->effective_rate;
            $nonfunded_spread= $request->nonfunded_spread;
            $nonfunded_ef_rate= $request->nonfunded_ef_rate;

            for ($i = 0; $i < sizeof($pricing); $i++) {
                if ($pricing[$i] != "" || $facility[$i] !="" || $spread[$i] !=""  || $effective_rate[$i] !="" ) {
                    $cod = new CovenantDetails;
                    $cod->covenants_id = $co->id;
                    $cod->pricing = $pricing[$i];
                    $cod->type_nonfunded = $type_nonfunded[$i];
                    $cod->nonfunded_spread = $nonfunded_spread[$i];
                    $cod->nonfunded_ef_rate = $nonfunded_ef_rate[$i];
                    $cod->fund_type = $fund_type[$i];
                    $cod->facility = $facility[$i];
                    $cod->spread = $spread[$i];
                    $cod->effective_rate = $effective_rate[$i];
                    $cod->save();
                    //Form  stage
                    $completed = 100;
                }
            }

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Covenants')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Create Covenants form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        else{
            $co =  Covenants::find($request->id);
            $co->appraisal_fee_1 = $request->appraisal_fee_1;
            $co->appraisal_fee_2 = $request->appraisal_fee_2;
            $co->appraisal_fee_3 = $request->appraisal_fee_3;
            $co->disbursal = $request->disbursal;
            $co->crp_id = $request->crp_id;
            $co->save();
            //Form  stage
            $completed = 50;

            //Insert Convernant details
            $pricing = $request->pricing;
            $type_nonfunded = $request->type_nonfunded;
            $fund_type = $request->fund_type;
            $facility = $request->facility;
            $spread = $request->spread;
            $effective_rate = $request->effective_rate;
            $nonfunded_spread= $request->nonfunded_spread;
            $nonfunded_ef_rate= $request->nonfunded_ef_rate;

            //Delete existing data
            $cov=CovenantDetails::where('covenants_id','=',$co->id)->delete();

            for ($i = 0; $i < sizeof($pricing); $i++) {
                if ($pricing[$i] != "" || $facility[$i] !="" || $spread[$i] !=""  || $effective_rate[$i] !="" ) {
                    $cod = new CovenantDetails;
                    $cod->covenants_id = $co->id;
                    $cod->pricing = $pricing[$i];
                    $cod->type_nonfunded = $type_nonfunded[$i];
                    $cod->fund_type = $fund_type[$i];
                    $cod->facility = $facility[$i];
                    $cod->spread = $spread[$i];
                    $cod->effective_rate = $effective_rate[$i];
                    $cod->save();
                    //Form  stage
                    $completed = 100;
                }
            }

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Covenants')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update Covenants form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        return "<h4 class='alert alert-info'>Data Successful Saved </h4>";
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
