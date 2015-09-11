<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FacilityStructure;
use App\FinalRecommendations;
use App\Http\Requests\FinalRecommendationsRequest;
use App\FormStage;
use App\CreditApp;
use Illuminate\Support\Facades\Auth;
use App\Audit;

class FinalRecommendationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		//

        return view('caproposal.Finalrecommendations',compact('id'));
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
	public function store(FinalRecommendationsRequest $request)
	{
		//
        if( $request->apprequest ==0) //create new profile
        {
            $frec=FinalRecommendations::where('fs_id','=',$request->fs_id)->delete();
            $i=0;
             foreach($request->facility as $fc){
                 $fr=new FinalRecommendations;
                 $fr->facility=$fc;
                 $fr->facility_comments=$request->facility_comments[$i];
                 $fr->fs_id=$request->fs_id;
                 $fr->amount=$request->amount[$i];
                 $fr->tenor=$request->tenor[$i];
                 $fr->rate_interest=$request->rate_interest[$i];
                 $fr->cr_pricing=$request->cr_pricing[$i];
                 $fr->repayment=$request->repayment[$i];
                 $fr->facility_fee=$request->facility_fee[$i];
                 $fr->review_date=$request->review_date[$i];
                 $fr->crp_id=$request->crp_id;
                 $fr->save();
                 $i++;
             }
            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Final recommendations')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=100;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Create  Final recommendations form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        else
        {
            $frec=FinalRecommendations::where('fs_id','=',$request->fs_id)->delete();

            $i=0;
            foreach($request->facility as $fc){
                $fr=new FinalRecommendations;
                $fr->facility=$fc;
                $fr->facility_comments=$request->facility_comments[$i];
                $fr->fs_id=$request->fs_id;
                $fr->amount=$request->amount[$i];
                $fr->tenor=$request->tenor[$i];
                $fr->rate_interest=$request->rate_interest[$i];
                $fr->cr_pricing=$request->cr_pricing[$i];
                $fr->repayment=$request->repayment[$i];
                $fr->facility_fee=$request->facility_fee[$i];
                $fr->review_date=$request->review_date[$i];
                $fr->crp_id=$request->crp_id;
                $fr->save();
                $i++;
            }
            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Final recommendations')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=100;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Create  Final recommendations form  for Application  " .$cr->ac_name;
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

    public static function checkOverdraft($str)
    {
        $pos=strpos(strtolower($str),strtolower("overdraft"));
        if($pos ===true) {
            return true;} else {return false;}
    }

}
