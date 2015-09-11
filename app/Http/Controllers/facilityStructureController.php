<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FacilityStructure;
use App\FacilityStructureGroup;
use App\FacilityStructureLimits;
use App\Http\Requests\FacilityStructureRequest;
use App\FormStage;
use Illuminate\Support\Facades\Auth;
use App\Audit;
use App\CreditApp;
use App\FinalRecommendations;
class facilityStructureController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		//
        return view('caproposal.facilitystructure',compact('id'));
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
	public function store(FacilityStructureRequest $request)
	{
        //Get determination details for update or insert new
        $apprequest=$request->apprequest;

        //Process new insertion

        if($request->apprequest == 0) {

            //
            $fs = new FacilityStructure;
            $fs->crp_id = $request->crid;
            $fs->purpose = $request->purpose;
            $fs->remarks = $request->remarks;
            $fs->msg = $request->msg;
            $fs->rate_applied = $request->rate_applied;
            if($request->valid_date !="") {
                $fs->valid_date = date("Y-m-d",strtotime($request->valid_date));
            }else{$fs->valid_date ="";}

            $fs->save();

            //Form  stage
            $completed = 10;

            //Prossess limits
            $facility = $request->facility;
            $ccy_1 = $request->ccy_1;
            $cr_limits = $request->cr_limits;
            $ccy_2 = $request->ccy_2;
            $presentos = $request->presentos;
            $proposed = $request->proposed;
            $expire = $request->expire;

            //Remove all Final recommendations
            $fnl=FinalRecommendations::where('fs_id', '=', $request->id)->delete();


            for ($i = 0; $i < sizeof($facility); $i++) {
                if ($facility[$i] != ""  || $cr_limits[$i] != "" || $presentos[$i] != "" || $proposed[$i] != "" || $expire[$i] != "") {
                    $fsl = new FacilityStructureLimits;
                    $fsl->fs_id = $fs->id;
                    $fsl->facility = $facility[$i];
                    $fsl->ccy_1 = $ccy_1[$i];
                    $fsl->ccy_2 = $ccy_2[$i];
                    $fsl->cr_limits = $cr_limits[$i];
                    $fsl->presentos = $presentos[$i];
                    $fsl->proposed = $proposed[$i];
                    $fsl->expire = $expire[$i];

                    $fsl->save();
                    //Form  stage
                    $completed = 100;

                    //process
                    $fr=new FinalRecommendations;
                    $fr->facility=$facility[$i];
                    $fr->fs_id=$fs->id;

                    $fr->save();

                }

            }

            //Process group limits
            if ($request->g_indicator != "" && $request->g_indicator == "Yes")
            {
                $g_client = $request->g_client;
            $g_facility = $request->g_facility;
            $g_ccy = $request->g_ccy;
            $g_existing_limit = $request->g_existing_limit;
            $g_osbalance = $request->g_osbalance;
            $g_proposed_limit = $request->g_proposed_limit;
            $g_gel = $request->g_gel;

            for ($i = 0; $i < sizeof($g_client); $i++) {
                if ($g_facility[$i] != "" || $g_client[$i] != ""  || $g_existing_limit[$i] != "" || $g_osbalance[$i] != "" || $g_proposed_limit[$i] != "" || $g_gel[$i] != "") {

                    $fsg = new FacilityStructureGroup;
                    $fsg->fs_id = $fs->id;
                    $fsg->facility = $g_facility[$i];
                    $fsg->client = $g_client[$i];
                    $fsg->ccy = $g_ccy[$i];
                    $fsg->existing_limit = $g_existing_limit[$i];
                    $fsg->osbalance = $g_osbalance[$i];
                    $fsg->proposed_limit = $g_proposed_limit[$i];
                    $fsg->gel = $g_gel[$i];

                    $fsg->save();

                    //Form  stage
                    $completed = 100;
                }

            }
        }
            else
            {
                $completed = 100;
            }
            //Hold credit id for further use

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crid)->where('stage_name','=','Facility Structure')->first();
            $formStage->crp_id=$request->crid;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Created  Facility Structure form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        else {
            $fs = FacilityStructure::find($request->id);
            $fs->crp_id = $request->crid;
            $fs->purpose = $request->purpose;
            $fs->remarks = $request->remarks;
            $fs->msg = $request->msg;
            $fs->rate_applied = $request->rate_applied;
            if($request->valid_date !="") {
                $fs->valid_date = date("Y-m-d",strtotime($request->valid_date));
            }else{$fs->valid_date ="";}
            $fs->save();

            //Form  stage
            $completed = 10;
            //Remove all Final recommendations
            $fnl=FinalRecommendations::where('fs_id', '=', $request->id)->delete();

            //Prossess limits
            $facility = $request->facility;
            $ccy_1 = $request->ccy_1;
            $cr_limits = $request->cr_limits;
            $ccy_2 = $request->ccy_2;
            $presentos = $request->presentos;
            $proposed = $request->proposed;
            $expire = $request->expire;

            //Delete all data first
            $limit = FacilityStructureLimits::where('fs_id', '=', $request->id)->delete();

            for ($i = 0; $i < sizeof($facility); $i++) {
                if ($facility[$i] != ""  || $cr_limits[$i] != "" || $presentos[$i] != "" || $proposed[$i] != "" || $expire[$i] != "") {
                    $fsl = new FacilityStructureLimits;
                    $fsl->fs_id = $fs->id;
                    $fsl->facility = $facility[$i];
                    $fsl->ccy_1 = $ccy_1[$i];
                    $fsl->ccy_2 = $ccy_2[$i];
                    $fsl->cr_limits = $cr_limits[$i];
                    $fsl->presentos = $presentos[$i];
                    $fsl->proposed = $proposed[$i];
                    $fsl->expire = $expire[$i];

                    $fsl->save();
                    //Form  stage
                    $completed = 100;

                    //process
                    $fr=new FinalRecommendations;
                    $fr->facility=$facility[$i];
                    $fr->fs_id=$fs->id;

                    $fr->save();

                }

            }


            //Process group limits
            if ($request->g_indicator != "" && $request->g_indicator == "Yes")
            {
            $g_client = $request->g_client;
            $g_facility = $request->g_facility;
            $g_ccy = $request->g_ccy;
            $g_existing_limit = $request->g_existing_limit;
            $g_osbalance = $request->g_osbalance;
            $g_proposed_limit = $request->g_proposed_limit;
            $g_gel = $request->g_gel;

            $g = FacilityStructureGroup::where('fs_id', '=', $request->id)->delete();

            for ($i = 0; $i < sizeof($g_client); $i++) {
                if ($g_facility[$i] != ""|| $g_client[$i] != ""  || $g_existing_limit[$i] != "" || $g_osbalance[$i] != "" || $g_proposed_limit[$i] != "" || $g_gel[$i] != "") {

                    $fsg = new FacilityStructureGroup;
                    $fsg->fs_id = $fs->id;
                    $fsg->facility = $g_facility[$i];
                    $fsg->client = $g_client[$i];
                    $fsg->ccy = $g_ccy[$i];
                    $fsg->existing_limit = $g_existing_limit[$i];
                    $fsg->osbalance = $g_osbalance[$i];
                    $fsg->proposed_limit = $g_proposed_limit[$i];
                    $fsg->gel = $g_gel[$i];

                    $fsg->save();

                    //Form  stage
                    $completed = 100;
                }

            }
        } else
            {
                $completed = 100;
            }

             //Hold credit id for further use
            $id = $request->crp_id;

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crid)->where('stage_name','=','Facility Structure')->first();
            $formStage->crp_id=$request->crid;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update  Facility Structure form  for Application  " .$cr->ac_name;
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
