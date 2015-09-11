<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\AnnexureIIRequest;
use App\FormStage;
use App\CreditApp;
use Illuminate\Support\Facades\Auth;
use App\Audit;
use App\AnnexureII;

class AnnexureIIController extends Controller {

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
    public function store(AnnexureIIRequest $request)
    {
        //
        if( $request->apprequest ==0) //create new profile
        {
            $ann = new AnnexureII;
            $ann->crp_id=$request->crp_id;
            $ann->title=$request->title;
            $ann->contents=$request->contents;
            $ann->save();

            //Process Forms
            $completed=100;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Annexure-II')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Create Annexure-II form  for Application  " .$cr->ac_name;
            $audit->save();

        }
        else
        {
            $ann= AnnexureII::find($request->id);
            $ann->crp_id=$request->crp_id;
            $ann->title=$request->title;
            $ann->contents=$request->contents;
            $ann->save();

            //Process Forms
            $completed=100;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Annexure-II')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update Annexure-II form  for Application  " .$cr->ac_name;
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
