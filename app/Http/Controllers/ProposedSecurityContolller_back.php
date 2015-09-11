<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ProposedSecurity;
use App\Http\Requests\ProposedSecurityRequest;
use App\ProposedSecurityDetailed;
use App\FormStage;
use App\CreditApp;
use Illuminate\Support\Facades\Auth;
use App\Audit;
class ProposedSecurityContoller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		//
        return view('caproposal.Proposedsecurity',compact('id'));

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
	public function store(ProposedSecurityRequest $request)
	{
        if( $request->apprequest ==0) //create new profile
        {
            //
            $ps = new ProposedSecurity;
            $ps->crp_id = $request->crp_id;
            $ps->status = $request->security_status;
            $ps->save();

            //Process Forms
            $completed=25;

            //Process Batch for proposed security details
            $location = $request->location;
            $area = $request->area;
            $certificate = $request->certificate;
            $owner = $request->owner;
            $immovable=$request->immovable;

            $plot_area = $request->plot_area;
            $valued_by = $request->valued_by;
            $valued_on = $request->valued_on;
            $valued_at = $request->valued_at;
            $open_marketvalue = $request->open_marketvalue;
            $forced_salevalue = $request->forced_salevalue;
            $tobe_charges = $request->tobe_charges;
            $status= $request->status;
            $security_type=$request->security_type;
            $existing_security=$request->existing_security;

            //Process proposed security_type

            for ($i = 0; $i < sizeof($location); $i++) {

                //Check security type
                if($security_type[$i] != "" && $security_type[$i]=="Landed Property") {

                    if ( $location[$i] != "" || $open_marketvalue[$i] !="" || $forced_salevalue[$i] !="" || $tobe_charges[$i] !=""  || $immovable[$i] !="" || $status[$i] !="" ||  $area[$i] !="") {
                        $psd = new  ProposedSecurityDetailed;
                        $psd->ps_id = $ps->id;
                        $psd->security_type = $security_type[$i];
                        $psd->open_marketvalue = $open_marketvalue[$i];
                        $psd->forced_salevalue = $forced_salevalue[$i];
                        $psd->tobe_charges = $tobe_charges[$i];
                        $psd->immovable = $immovable[$i];
                        $psd->location = $location[$i];
                        $psd->tennor = $status[$i];
                        $psd->area = $area[$i];
                        $psd->certificate = $certificate[$i];
                        $psd->plot_area = $plot_area[$i];
                        $psd->valued_by = $valued_by[$i];
                        $psd->valued_on = $valued_on[$i];
                        $psd->valued_at = $valued_at[$i];
                        $psd->owner = $owner[$i];

                        $psd->save();
                        //Process Forms
                        $completed = 100;
                    }
                }
                else
                {

                    if (  $open_marketvalue[$i] !="" || $forced_salevalue[$i] !="" || $tobe_charges[$i] !=""  || $existing_security[$i] !="" ) {

                        $psd = new  ProposedSecurityDetailed;
                        $psd->ps_id = $ps->id;
                        $psd->security_type = $security_type[$i];
                        $psd->open_marketvalue = $open_marketvalue[$i];
                        $psd->forced_salevalue = $forced_salevalue[$i];
                        $psd->tobe_charges = $tobe_charges[$i];
                        $psd->existing_security = $existing_security[$i];
                        $psd->save();
                        //Process Forms
                        $completed = 100;
                    }

                }

            }


            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Proposed security')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Create Proposed security form  for Application  " .$cr->ac_name;
            $audit->save();

        }
        else
        {
            //
            $ps =  ProposedSecurity::find($request->id);
            $ps->crp_id = $request->crp_id;
            $ps->status = $request->security_status;
            $ps->save();

            //Process Forms
            $completed=25;

            //Process Batch for proposed security details
            $location = $request->location;
            $area = $request->area;
            $certificate = $request->certificate;
            $owner = $request->owner;
            $immovable=$request->immovable;

            $plot_area = $request->plot_area;
            $valued_by = $request->valued_by;
            $valued_on = $request->valued_on;
            $valued_at = $request->valued_at;
            $open_marketvalue = $request->open_marketvalue;
            $forced_salevalue = $request->forced_salevalue;
            $tobe_charges = $request->tobe_charges;
            $status= $request->status;
            $security_type=$request->security_type;
            $existing_security=$request->existing_security;

            echo "$forced_salevalue=" .$forced_salevalue[0];
            exit;

            //Process proposed security_type


            $dt=ProposedSecurityDetailed::where('ps_id','=',$ps->id)->delete();

            for ($i = 0; $i < sizeof($location); $i++) {
                //Check security type
                if($security_type[$i] != "" && $security_type[$i]=="Landed Property") {

                    if ( $location[$i] != "" || $open_marketvalue[$i] !="" || $forced_salevalue[$i] !="" || $tobe_charges[$i] !=""  || $immovable[$i] !="" || $status[$i] !="" ||  $area[$i] !="") {
                        $psd = new  ProposedSecurityDetailed;
                        $psd->ps_id = $ps->id;
                        $psd->security_type = $security_type[$i];
                        $psd->open_marketvalue = $open_marketvalue[$i];
                        $psd->forced_salevalue = $forced_salevalue[$i];
                        $psd->tobe_charges = $tobe_charges[$i];
                        $psd->immovable = $immovable[$i];
                        $psd->location = $location[$i];
                        $psd->tennor = $status[$i];
                        $psd->area = $area[$i];
                        $psd->certificate = $certificate[$i];
                        $psd->plot_area = $plot_area[$i];
                        $psd->valued_by = $valued_by[$i];
                        $psd->valued_on = $valued_on[$i];
                        $psd->valued_at = $valued_at[$i];
                        $psd->owner = $owner[$i];

                        $psd->save();
                        //Process Forms
                        $completed = 100;
                    }
                }
                else
                {
                    if (  $open_marketvalue[$i] !="" || $forced_salevalue[$i] !="" || $tobe_charges[$i] !=""  || $existing_security[$i] !="" ) {
                    $psd = new  ProposedSecurityDetailed;
                    $psd->ps_id = $ps->id;
                    $psd->security_type = $security_type[$i];
                    $psd->open_marketvalue = $open_marketvalue[$i];
                    $psd->forced_salevalue = $forced_salevalue[$i];
                    $psd->tobe_charges = $tobe_charges[$i];
                    $psd->existing_security= $existing_security[$i];
                    $psd->save();
                    //Process Forms
                    $completed = 100;
                    }

                }

            }


            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Proposed security')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update Proposed security form  for Application  " .$cr->ac_name;
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
