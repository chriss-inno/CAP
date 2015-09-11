<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Swot_Analysis;
use App\Http\Requests\SwotAnalysisRequest;
use App\FormStage;
use App\CreditApp;
use Illuminate\Support\Facades\Auth;
use App\Audit;

class SwotAnalysisController extends Controller {

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
	public function store(SwotAnalysisRequest $request)
	{
		//
        if( $request->apprequest ==0) //create new profile
        {
            $sw=new Swot_Analysis;
            $sw->swot_strength=$request->swot_strength;
            $sw->swot_weaknesses=$request->swot_weaknesses;
            $sw->swot_opportunities=$request->swot_opportunities;
            $sw->swot_threats=$request->swot_threats;
            $sw->crp_id=$request->crp_id;

            $sw->save();

            //Process Forms
            $completed=100;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Swot Analysis')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Create Swot Analysis form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        else
        {
            $sw= Swot_Analysis::find($request->id);
            $sw->swot_strength=$request->swot_strength;
            $sw->swot_weaknesses=$request->swot_weaknesses;
            $sw->swot_opportunities=$request->swot_opportunities;
            $sw->swot_threats=$request->swot_threats;
            $sw->crp_id=$request->crp_id;

            $sw->save();

            //Process Forms
            $completed=100;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Swot Analysis')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update Swot Analysis form  for Application  " .$cr->ac_name;
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
