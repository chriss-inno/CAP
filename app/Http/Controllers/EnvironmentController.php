<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Environment;
use App\Http\Requests\EnvironmentRequest;
use App\FormStage;
use App\CreditApp;
use Illuminate\Support\Facades\Auth;
use App\Audit;
class EnvironmentController extends Controller {

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
	public function store(EnvironmentRequest $request)
	{
		//

        if( $request->apprequest ==0) //create new profile
        {
            $e = new Environment;
            $e->crp_id=$request->crp_id;
            $e->political_economic=$request->political_economic;
            $e->sector_performance=$request->sector_performance;
            $e->position_sector=$request->position_sector;
            $e->regulatory=$request->regulatory;
            $e->environmental_issues=$request->environmental_issues;
            $e->save();
            //Process Forms
            $completed=100;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Environment Review')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Created  Credit Risk Grading form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        else
        {
            $e =  Environment::find($request->id);
            $e->crp_id=$request->crp_id;
            $e->political_economic=$request->political_economic;
            $e->sector_performance=$request->sector_performance;
            $e->position_sector=$request->position_sector;
            $e->regulatory=$request->regulatory;
            $e->environmental_issues=$request->environmental_issues;
            $e->save();
            //Process Forms
            $completed=100;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Environment Review')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update  Credit Risk Grading form  for Application  " .$cr->ac_name;
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
