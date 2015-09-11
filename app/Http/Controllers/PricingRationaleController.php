<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\PricingRationaleRequest;
use App\PricingRationale;
use App\PricingRationaleDetails;
use App\FormStage;
use Illuminate\Support\Facades\Auth;
use App\Audit;
use App\CreditApp;
class PricingRationaleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
	public function store(PricingRationaleRequest $request)
	{
		//
        if( $request->apprequest ==0) //create new profile
        {
            //Process Price rationaire
            $completed = 0;

            $pr = new PricingRationale;
            $pr->coments = $request->coments;
            $pr->crp_id = $request->crp_id;
            $pr->save();

            //Form  stage
            $completed = 50;

            //Process price rationaire detaile
            $p_facility = $request->p_facility;
            $p_interest = $request->p_interest;
            $p_fees = $request->p_fees;

            for ($i = 0; $i < sizeof($p_facility); $i++) {
                if ($p_facility[$i] != "" || $p_interest[$i] !="" || $p_fees[$i] !="" ) {

                    $prd = new PricingRationaleDetails;
                    $prd->pricing_rationale_id = $pr->id;
                    $prd->facility = $p_facility[$i];
                    $prd->anual_interest = $p_interest[$i];
                    $prd->fees = $p_fees[$i];
                    $prd->save();

                    //Form  stage
                    $completed = 100;
                }
            }

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Pricing Rationale')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Create Pricing Rationale form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        else{

            //Process Price rationaire
            $completed = 0;

            $pr =  PricingRationale::find($request->id);
            $pr->coments = $request->coments;
            $pr->crp_id = $request->crp_id;
            $pr->save();

            //Form  stage
            $completed = 50;

            //Process price rationaire detaile
            $p_facility = $request->p_facility;
            $p_interest = $request->p_interest;
            $p_fees = $request->p_fees;

            //Delete existing data
            $prcd=PricingRationaleDetails::where('pricing_rationale_id','=',$pr->id)->delete();

            for ($i = 0; $i < sizeof($p_facility); $i++) {
                if ($p_facility[$i] != "" || $p_interest[$i] !="" || $p_fees[$i] !="" ) {

                    $prd = new PricingRationaleDetails;
                    $prd->pricing_rationale_id = $pr->id;
                    $prd->facility = $p_facility[$i];
                    $prd->anual_interest = $p_interest[$i];
                    $prd->fees = $p_fees[$i];
                    $prd->save();

                    //Form  stage
                    $completed = 100;
                }
            }
            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Pricing Rationale')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update Pricing Rationale form  for Application  " .$cr->ac_name;
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
