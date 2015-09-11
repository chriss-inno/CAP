<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\BusinessActivity;
use App\Http\Requests\BusinessActivityRequest;
use App\FormStage;
use App\CreditApp;
use App\Audit;
use Illuminate\Support\Facades\Auth;

class BusinessActivitiesController extends Controller {

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
	public function store(BusinessActivityRequest $request)
	{
		//
        if( $request->apprequest ==0) //create new profile
        {
            $ba=new  BusinessActivity;
            $ba->business_activity=$request->business_activity;
            $ba->org_hq=$request->org_hq;
            $ba->product_traded=$request->product_traded;
            $ba->credit_terms=$request->credit_terms;
            $ba->sales_distributions=$request->sales_distributions;
            $ba->crp_id=$request->crp_id;
            $ba->save();

            //Process Forms
            $completed=100;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Business Activity Review')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Created  Business Activity Review form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        else
        {
            $ba=  BusinessActivity::find($request->id);
            $ba->business_activity=$request->business_activity;
            $ba->org_hq=$request->org_hq;
            $ba->product_traded=$request->product_traded;
            $ba->credit_terms=$request->credit_terms;
            $ba->sales_distributions=$request->sales_distributions;
            $ba->crp_id=$request->crp_id;
            $ba->save();

            //Process Forms
            $completed=100;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Business Activity Review')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update  Business Activity Review form  for Application  " .$cr->ac_name;
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
