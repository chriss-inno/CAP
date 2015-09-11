<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\AccountPerformanceRequest;
use App\AccountPerformance;
use App\AccountPerformanceBank;
use App\AccountPerformanceTZS;
use App\AccountPerformanceUSD;
use App\Http\Controllers\FinalRecommendationsController;
use App\FacilityStructure;
use App\CreditApp;
use App\FormStage;
use App\Audit;
use Illuminate\Support\Facades\Auth;
class AccountPerformanceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		//
        return view('caproposal.Accountperformance',compact('id'));
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
	public function store(AccountPerformanceRequest $request)
	{
		//

        if( $request->apprequest ==0) //create new profile
        {
            $acp = new AccountPerformance;
            $acp->crp_id = $request->crp_id;
            $acp->comments = $request->comments;
            $acp->save();

            //Form  stage
            $completed = 25;

            //Process bank Maintained

            $id = $request->crp_id;

            $bank_maintained = $request->bank_maintained;
            $i=0;
            foreach ($bank_maintained as $bk) {
                $acpb = new AccountPerformanceBank;
                $acpb->a_p_id = $acp->id;
                $acpb->bank_maintained = $bk;
                $acpb->loan_disbursement_tzs =$request->loan_disbursement[$i];
                $acpb->Credit_turnover_tzs = $request->Credit_turnover[$i];
                $acpb->loan_disbursement_usd = $request->loan_disbursement_usd[$i];
                $acpb->Credit_turnover_usd = $request->Credit_turnover_usd[$i];
                $acpb->save();

                //Form  stage
                $completed = 50;
                $i++;
            }


            //Process ACperformance TZS

            $tzs_month = $request->tzs_month;
            $tzs_low_balance = $request->tzs_low_balance;
            $tzs_high_balance = $request->tzs_high_balance;
            $tzs_turnover = $request->tzs_turnover;
            $i = 0;
            foreach ( $tzs_month as $mtzs) {
                if ($mtzs != "" && $tzs_low_balance[$i] != "" && $tzs_high_balance[$i] != "" && $tzs_turnover[$i] != "") {
                    $acptzs = new AccountPerformanceTZS;
                    $acptzs->a_p_id = $acp->id;
                    $acptzs->tzs_month = $mtzs;
                    $acptzs->tzs_low_balance = $tzs_low_balance[$i];
                    $acptzs->tzs_high_balance = $tzs_high_balance[$i];
                    $acptzs->tzs_turnover = $tzs_turnover[$i];
                    $acptzs->save();
                    $i++;
                    //Form  stage
                    $completed = 100;
                }
            }

            //Process ACperformance USD

            $usd_month = $request->usd_month;
            $usd_low_balance = $request->usd_lbalance;
            $usd_high_balance = $request->usd_hbalance;
            $usd_turnover = $request->usd_turnover;

            $i=0;
            foreach ($usd_month as $musd) {
                if ($musd != "" && $usd_low_balance[$i] != "" && $usd_high_balance[$i] != "" && $usd_turnover[$i] != "") {
                    $acpusd = new AccountPerformanceUSD;
                    $acpusd->a_p_id = $acp->id;
                    $acpusd->usd_month = $musd;
                    $acpusd->usd_low_balance = $usd_low_balance[$i];
                    $acpusd->usd_high_balance = $usd_high_balance[$i];
                    $acpusd->usd_turnover = $usd_turnover[$i];
                    $acpusd->save();
                    $i++;
                    //Form  stage
                    $completed = 100;
                }
            }

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Account performance')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application-Account performance";
            $audit->action="Created  Account performance  for Application  " .$cr->ac_name;
            $audit->save();

        }
        else
        {
            $acp = AccountPerformance::find($request->id);
            $acp->crp_id = $request->crp_id;
            $acp->comments = $request->comments;
            $acp->save();

            //Form  stage
            $completed = 25;

            //Process bank Maintained

            $id = $request->crp_id;

            $bank_maintained = $request->bank_maintained;

            $ac=AccountPerformanceBank::where('a_p_id','=',$acp->id)->delete();

            $i=0;
            foreach ($bank_maintained as $bk) {
                $acpb = new AccountPerformanceBank;
                $acpb->a_p_id = $acp->id;
                $acpb->bank_maintained = $bk;
                $acpb->loan_disbursement_tzs =$request->loan_disbursement[$i];
                $acpb->Credit_turnover_tzs = $request->Credit_turnover[$i];
                $acpb->loan_disbursement_usd = $request->loan_disbursement_usd[$i];
                $acpb->Credit_turnover_usd = $request->Credit_turnover_usd[$i];
                $acpb->save();
                $i++;
                //Form  stage
                $completed = 50;
            }


            //Process ACperformance TZS

            $tzs_month = $request->tzs_month;
            $tzs_low_balance = $request->tzs_low_balance;
            $tzs_high_balance = $request->tzs_high_balance;
            $tzs_turnover = $request->tzs_turnover;

            $ac=AccountPerformanceTZS::where('a_p_id','=',$acp->id)->delete();
            $i=0;
            foreach ( $tzs_month as $mtzs ) {
                if ($mtzs  != "" && $tzs_low_balance[$i] != "" && $tzs_high_balance[$i] != "" && $tzs_turnover[$i] != "") {
                    $acptzs = new AccountPerformanceTZS;
                    $acptzs->a_p_id = $acp->id;
                    $acptzs->tzs_month = $mtzs;
                    $acptzs->tzs_low_balance = $tzs_low_balance[$i];
                    $acptzs->tzs_high_balance = $tzs_high_balance[$i];
                    $acptzs->tzs_turnover = $tzs_turnover[$i];
                    $acptzs->save();
                    $i++;
                    //Form  stage
                    $completed = 100;
                }
            }

            //Process ACperformance USD

            $usd_month = $request->usd_month;
            $usd_low_balance = $request->usd_lbalance;
            $usd_high_balance = $request->usd_hbalance;
            $usd_turnover = $request->usd_turnover;

            $ac=AccountPerformanceUSD::where('a_p_id','=',$acp->id)->delete();

            $i = 0;
            foreach ($usd_month as $musd) {
                if ($musd != "" && $usd_low_balance[$i] != "" && $usd_high_balance[$i] != "" && $usd_turnover[$i] != "") {
                    $acpusd = new AccountPerformanceUSD;
                    $acpusd->a_p_id = $acp->id;
                    $acpusd->usd_month = $musd;
                    $acpusd->usd_low_balance = $usd_low_balance[$i];
                    $acpusd->usd_high_balance = $usd_high_balance[$i];
                    $acpusd->usd_turnover = $usd_turnover[$i];
                    $acpusd->save();

                    $i ++;
                    //Form  stage
                    $completed = 100;
                }
            }

            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Account performance')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application-Account performance";
            $audit->action="Updated  Account performance  for Application  " .$cr->ac_name;
            $audit->save();

        }
       return "<h4> Data successful uploaded</h4>";
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
