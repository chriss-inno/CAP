<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Audit;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreditRiskGradingRequest;
use Monolog\Handler\ElasticSearchHandlerTest;
use App\CreditRiskGrading;
use App\FormStage;
use App\QualitativeAnalysis;
use App\QuantitativeAnalysis;
use App\CreditApp;


class CreditRiskGradingController extends Controller {

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
	public function store(CreditRiskGradingRequest $request)
	{
		//
 if( $request->apprequest ==0) //create new profile
 {
     //Form  stage
     $completed=0;
     $crg=new CreditRiskGrading;
     $crg->crp_id= $request->crp_id;
     $crg->save();

     $completed=25;

     //Process Quantitative analysis

     $q=new QuantitativeAnalysis;
     $q->crg_id = $crg->id;
     $q->Current_Ratio=$request->Current_Ratio;
     $q->Debt_Service=$request->Debt_Service;
     $q->Dept_Equity=$request->Dept_Equity;
     $q->Asset_Coverage=$request->Asset_Coverage;
     $q->Security_Cove=$request->Security_Cove;
     $q->Operation_Profit=$request->Operation_Profit;
     $q->save();

     $completed=75;

     //Process Qualitative
      $qa=new QualitativeAnalysis;
      $qa->crg_id = $crg->id;
     $qa->Management=$request->Management;
     $qa->Market_share=$request->Market_share;
     $qa->Concentration_risk=$request->Concentration_risk;
     $qa->Track_record=$request->Track_record;
     $qa->Compliance_record=$request->Compliance_record;
     $qa->auditing_firm=$request->auditing_firm;
      $qa->save();


      $completed=100;

     //Process form stages
     $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Credit Risk Grading')->first();
     $formStage->crp_id=$request->crp_id;
     $formStage->stage_name="Credit Risk Grading";
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
     $completed=0;
     $crg= CreditRiskGrading::find($request->id);

     $completed=25;

     //Process Quantitative analysis

     $q=new QuantitativeAnalysis;
     $q->crg_id = $crg->id;
     $q->Current_Ratio=$request->Current_Ratio;
     $q->Debt_Service=$request->Debt_Service;
     $q->Dept_Equity=$request->Dept_Equity;
     $q->Asset_Coverage=$request->Asset_Coverage;
     $q->Security_Cove=$request->Security_Cove;
     $q->Operation_Profit=$request->Operation_Profit;
     $q->save();
     $completed=75;



     //Process Qualitative
     $dt=QualitativeAnalysis::where('crg_id','=',$crg->id)->delete();



     $qa=new QualitativeAnalysis;
     $qa->crg_id = $crg->id;
     $qa->Management=$request->Management;
     $qa->Market_share=$request->Market_share;
     $qa->Concentration_risk=$request->Concentration_risk;
     $qa->Track_record=$request->Track_record;
     $qa->Compliance_record=$request->Compliance_record;
     $qa->auditing_firm=$request->auditing_firm;
     $qa->save();
     $completed=100;

     //Process form stages
     $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Credit Risk Grading')->first();
     $formStage->crp_id=$request->crp_id;
     $formStage->stage_name="Credit Risk Grading";
     $formStage->completed=$completed;
     $formStage->save();

     //Process Audits
     $cr=CreditApp::find($request->crp_id)->first();
     $audit=new Audit;
     $audit->user_id =Auth::user()->id;
     $audit->module="Credit Proposal Application";
     $audit->action="Update  credit risk grading form  for Application  " .$cr->ac_name;
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
