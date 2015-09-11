<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\FormStage;
use App\CreditApp;
use App\PDF;
class processformController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function __construc()
    {
        if(Auth::guest())
        {
            return view('users.login');
        }
    }

    public function processform($id)
    {
       $form =FormStage::find($id);
        $id=$form->crp_id;


       switch($form->stage_name)
       {
           case "Account performance":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.Accountperformance',compact('crp'));
           break;
           case "Covenants":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.Covenants',compact('crp'));
               break;
           case "Facility Structure":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.facilitystructure',compact('crp'));
               break;
           case "Final recommendations":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.Finalrecommendations',compact('crp'));
               break;
           case "Proposed security":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.Proposedsecurity',compact('crp'));
               break;
           case "Pricing Rationale":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.pricerationaire',compact('crp'));
               break;
           case "Business Activity Review":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.BusinessActivity',compact('crp'));
               break;
           case "Environment Review":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.environmentreview',compact('crp'));
               break;
           case "Financial Analysis Review":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.financialanalysis',compact('crp'));
               break;
           case "Swot Analysis":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.SwotAnalysis',compact('crp'));
               break;
           case "Annexure-I":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.annexureI',compact('crp'));
               break;
           case "Annexure-II":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.annexureII',compact('crp'));
               break;
           case "Credit Risk Grading":
               $crp =CreditApp::find($id);
               return view('caproposal_edit.creditgrading',compact('crp'));
               break;
           case "Account profile":

               $crp =CreditApp::find($id);

               return view('caproposal_edit.accountprofile',compact('crp'));
               break;
           default;
               $crp =CreditApp::find($id);
               return view('caproposal_edit.accountprofile',compact('crp'));

       }

    }

    //Show form view
    public function formSummary($id)
    {
        $form =FormStage::find($id);
        $id=$form->crp_id;


        switch($form->stage_name)
        {
            case "Account performance":
                $crp =CreditApp::find($id);
                return view('caproposal_view.Accountperformance',compact('crp'));
                break;
            case "Covenants":
                $crp =CreditApp::find($id);
                return view('caproposal_view.Covenants',compact('crp'));
                break;
            case "Facility Structure":
                $crp =CreditApp::find($id);
                return view('caproposal_view.facilitystructure',compact('crp'));
                break;
            case "Final recommendations":
                $crp =CreditApp::find($id);
                return view('caproposal_view.Finalrecommendations',compact('crp'));
                break;
            case "Proposed security":
                $crp =CreditApp::find($id);
                return view('caproposal_view.Proposedsecurity',compact('crp'));
                break;
            case "Pricing Rationale":
                $crp =CreditApp::find($id);
                return view('caproposal_view.pricerationaire',compact('crp'));
                break;
            case "Business Activity Review":
                $crp =CreditApp::find($id);
                return view('caproposal_view.BusinessActivity',compact('crp'));
                break;
            case "Environment Review":
                $crp =CreditApp::find($id);
                return view('caproposal_view.environmentreview',compact('crp'));
                break;
            case "Financial Analysis Review":
                $crp =CreditApp::find($id);
                return view('caproposal_view.financialanalysis',compact('crp'));
                break;
            case "Swot Analysis":
                $crp =CreditApp::find($id);
                return view('caproposal_view.SwotAnalysis',compact('crp'));
                break;
            case "Annexure-I":
                $crp =CreditApp::find($id);
                return view('caproposal_view.annexureI',compact('crp'));
                break;
            case "Annexure-II":
                $crp =CreditApp::find($id);
                return view('caproposal_view.annexureII',compact('crp'));
                break;
            case "Credit Risk Grading":
                $crp =CreditApp::find($id);
                return view('caproposal_view.creditgrading',compact('crp'));
                break;
            case "Account profile":

                $crp =CreditApp::find($id);

                return view('caproposal_view.accountprofile',compact('crp'));
                break;
            default;
                $crp =CreditApp::find($id);
                return view('caproposal_view.accountprofile',compact('crp'));

        }

    }

    //Remove forms
    public function removeform($id)
    {
        $form =FormStage::find($id);
        $id=$form->crp_id;


        switch($form->stage_name)
        {
            case "Account performance":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->accountperformance != null && count($cap->accountperformance) >0)
                {
                    foreach($cap->accountperformance->accountperformanceBank as $fr)
                    {
                        $fr->delete();
                    }
                    foreach($cap->accountperformance->accountperformanceTZS as $fr)
                    {
                        $fr->delete();
                    }
                    foreach($cap->accountperformance->accountperformanceUSD as $fr)
                    {
                        $fr->delete();
                    }

                    $cap->accountperformance->delete();
                }
                break;
            case "Covenants":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->covenants != null && count($cap->covenants) >0)
                {
                    foreach($cap->covenants->pricing as $fr)
                    {
                        $fr->delete();
                    }

                    $cap->covenants->delete();
                }
                break;
            case "Facility Structure":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if( $cap->facilitystructure != null && count($cap->facilitystructure) >0)
                {
                    foreach($cap->facilitystructure->finalrecommendations as $fr)
                    {
                        $fr->delete();
                    }
                    foreach($cap->facilitystructure->facilitylimits as $fr)
                    {
                        $fr->delete();
                    }
                    foreach($cap->facilitystructure->facilitygroups as $fr)
                    {
                        $fr->delete();
                    }

                    $cap->facilitystructure->delete();
                }
                break;
            case "Final recommendations":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->finalRecommendations != null && count($cap->finalRecommendations) >0) {
                    foreach ($cap->finalRecommendations as $dt) {
                        $dt->delete();
                    }
                }
                break;
            case "Proposed security":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->proposedsecurity != null && count($cap->proposedsecurity) >0)
                {
                    foreach($cap->proposedsecurity->details as $fr)
                    {
                        $fr->delete();
                    }
                    $cap->proposedsecurity->delete();
                }
                break;
            case "Pricing Rationale":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->pricingrationale != null && count($cap->pricingrationale) >0)
                {

                     foreach($cap->pricingrationale->details as $fr)
                     {
                         $fr->delete();
                     }
                    $cap->pricingrationale->delete();
                }
                break;
            case "Business Activity Review":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->businessactivity != null && count($cap->businessactivity) >0)
                {
                    $cap->businessactivity->delete();
                }
                break;
            case "Environment Review":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->accountperformance != null && count($cap->accountperformance) >0)
                {
                    $cap->accountperformance->delete();
                }
                break;
            case "Financial Analysis Review":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if( $cap->financialAnalysis !=null && count($cap->financialAnalysis) !=0 )
                {
                    $cap->financialAnalysis->delete();
                }
                break;
            case "Swot Analysis":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->swotanalysis != null && count($cap->swotanalysis) >0 )
                {
                    $cap->swotanalysis->delete();
                }
                break;

            case "Annexure-I":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->annexure_i != null && count($cap->annexure_i) >0 )
                {
                    $cap->annexure_i->delete();
                }
                break;
            case "Annexure-II":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->annexure_ii != null && count($cap->annexure_ii) >0 )
                {
                    $cap->annexure_ii->delete();
                }
                break;
            case "Credit Risk Grading":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if( $cap->creditRiskGrading !=null && count($cap->creditRiskGrading) >0 )
                {
                    $cap->creditRiskGrading->delete();
                }
                break;
            case "Account profile":
                $cap =CreditApp::find($id);
                $form->completed=0;
                $form->save();

                if($cap->accountprofile != null && count($cap->accountprofile) > 0)
                {
                    $cap->accountprofile->delete();
                }
                break;
            default;
                $crp =CreditApp::find($id);
                return view('caproposal_view.accountprofile',compact('crp'));

        }

    }

    //Download PDF
    //Show form view
    public function downloadPDF($id)
    {
        $form =FormStage::find($id);
        $id=$form->crp_id;


        switch($form->stage_name)
        {
            case "Account performance":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.Accountperformance',compact('crp'));
                return $pdf->download('Account-performance.pdf');
                break;
            case "Covenants":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.Covenants',compact('crp'));
                return $pdf->download('Covenants.pdf');
                break;
            case "Facility Structure":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.facilitystructure',compact('crp'));
                return $pdf->download('facility-structure.pdf');
                break;
            case "Final recommendations":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.Finalrecommendations',compact('crp'));
                return $pdf->download('Final-recommendations.pdf');
                break;
            case "Proposed security":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.Proposedsecurity',compact('crp'));
                return $pdf->download('Proposed-security.pdf');
                break;
            case "Pricing Rationale":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.pricerationaire',compact('crp'));
                return $pdf->download('price-rationaire.pdf');
                break;
            case "Business Activity Review":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.BusinessActivity',compact('crp'));
                return $pdf->download('Business-Activity.pdf');
                break;
            case "Environment Review":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.environmentreview',compact('crp'));
                return $pdf->download('environment-review.pdf');
                break;
            case "Financial Analysis Review":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.financialanalysis',compact('crp'));
                return $pdf->download('financial-Analysis.pdf');
                break;
            case "Swot Analysis":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.SwotAnalysis',compact('crp'));
                return $pdf->download('Swot-Analysis.pdf');
                break;

            case "Annexure-I":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.annexureI',compact('crp'));
                return $pdf->download('Annexure-I.pdf');
                break;
            case "Annexure-II":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.annexureII',compact('crp'));
                return $pdf->download('Annexure-II.pdf');
                break;

            case "Credit Risk Grading":
                $crp =CreditApp::find($id);
                $pdf = \PDF::loadView('caproposal_pdf.creditgrading',compact('crp'));
                return $pdf->download('credit-risk-grading.pdf');
                break;
            case "Account profile":

                $crp =CreditApp::find($id);

                $pdf = \PDF::loadView('caproposal_pdf.accountprofile',compact('crp'));
                return $pdf->download('account-profile.pdf');

                break;
            default;
                $crp =CreditApp::find($id);
                return view('caproposal_pdf.accountprofile',compact('crp'));

        }

    }
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
	public function store()
	{
		//
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
