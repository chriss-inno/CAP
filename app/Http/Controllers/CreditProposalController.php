<?php namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\CreditProposalRequest;
use App\CASerialNumber;
use App\CapSerial;
use App\AppSignator;
use App\Audit;
use App\FormStage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReportGenerateRequest;
use App\CreditApp;
use App\Signator;
class CreditProposalController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
     *
	 */
    public function __construc()
    {
        if(Auth::guest())
        {
            return view('users.login');
        }
    }

	public function index()
	{
		//
        $creditapp= CreditApp::all();
        return view('caproposal.manage',compact('creditapp'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		//
        $customer=Customer::find($id);
        return view('caproposal.add',compact('customer'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreditProposalRequest $request)
    {
        // $CreditApp=new \App\CreditApp;

        //Generate Serial number
        $snos = 0;

        if (count(CASerialNumber::all()) > 0) {
            $snos = CASerialNumber::all()->first()->startno;
        }


        $capSerial = new CapSerial;
        $capSerial->serialno = $snos;
        $capSerial->save();
        $id = $capSerial->id;
        $capSerial->serialno = ($snos + $id);
        $capSerial->save();


        $sno = $capSerial->serialno . "/" . date("Y");

        $CreditApp = new CreditApp;
        $CreditApp->sno = $sno;
        $CreditApp->app_date = date("Y-m-d", strtotime($request->app_date));
        $CreditApp->open_type = $request->open_type;
        $CreditApp->app_type = $request->app_type;
        $CreditApp->approval_limit = $request->approval_limit;
        $CreditApp->customer_id=$request->customer_id;
        $CreditApp->inputer= Auth::user()->username;
        $CreditApp->created_by = Auth::user()->id;

        $CreditApp->save();

        //Process reference no
         $ref=date('Y').date('m').date('d').'CA'.$CreditApp->id;
        $CreditApp->reference_no=$ref;
        $CreditApp->save();
        $id = $CreditApp->id;

        //Process signarotories


        //Process Signatories
        if(count($request->sigscheck) > 0)
        {
            foreach ($request->sigscheck as $sigs)
            {
                $siarr = explode('###', $sigs);
                $sigapp = new Signator;
                $sigapp->crp_id = $CreditApp->id;
                $sigapp->names = $siarr[0];
                $sigapp->designation = $siarr[1];
                $sigapp->save();
            }
        }


        //Process form stages
        $stage_array=["Facility Structure","Proposed security","Covenants","Pricing Rationale","Account performance","Final recommendations","Business Activity Review","Environment Review","Financial Analysis Review","Swot Analysis","Annexure-I","Annexure-II","Credit Risk Grading"];
        foreach($stage_array as $stg)
        {
            $formStage =new FormStage();
            $formStage->crp_id=$id;
            $formStage->stage_name=$stg;
            $formStage->save();
        }
        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="  Credit Proposal Application";
        $audit->action=" Creating new  Credit Proposal Application for " .$request->ac_name ." With serial number ".$request->sno." And ID of ".$CreditApp->id;
        $audit->save();

        return redirect('credit-proposal/'.$id);

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
        $cap=CreditApp::find($id);
        return view('caproposal_edit.app',compact('cap'));

	}
    public function showselected($id)
    {
        //
        $cap=CreditApp::find($id);
        return view('caproposal_edit.appselected',compact('cap'));

    }

    //Public function delete


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function storeEdit(CreditProposalRequest $request)
    {


        $CreditApp=CreditApp::find($request->crid);
        $CreditApp->sno= $request->sno;
        $CreditApp->app_date= date("Y-m-d",strtotime($request->app_date));
        $CreditApp->open_type=$request->open_type;
        $CreditApp->app_type=$request->app_type;
        $CreditApp->approval_limit = $request->approval_limit;
        $CreditApp->updated_by=Auth::user()->id;

        $CreditApp->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Proposal Application";
        $audit->action="Update  Credit Proposal Application for " .$request->ac_name ." With serial number ".$request->sno." And ID of ".$CreditApp->id;
        $audit->save();


        return "<h4 class='alert alert-info'>Data Successful Saved </h4>";
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
       $crp=CreditApp::find($id);
        return view('caproposal_edit.edit',compact('crp'));
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
        $cap=CreditApp::find($id);

        if( $cap->shareholders != null && count($cap->shareholders) !=0) {
            foreach ($cap->shareholders as $dt) {
                $dt->delete();
            }
        }
        if( $cap->directors != null && count($cap->directors) !=0) {
            foreach ($cap->directors as $dt) {
                $dt->delete();
            }
        }
        if( $cap->facilitystructure != null && count($cap->facilitystructure) !=0)
        {
            $cap->facilitystructure->delete();
        }
        if( $cap->formstage != null && count($cap->formstage) !=0) {
            foreach ($cap->formstage as $dt) {
                $dt->delete();
            }
        }
        if( $cap->finalRecommendations != null && count($cap->finalRecommendations) !=0) {
            foreach ($cap->finalRecommendations as $dt) {
                $dt->delete();
            }
        }
       if($cap->accountprofile != null && count($cap->accountprofile) !=0)
       {
           $cap->accountprofile->delete();
       }
        if($cap->accountperformance != null && count($cap->accountperformance) !=0)
        {
            foreach ($cap->accountperformance->accountperformanceTZS as $dt) {
                $dt->delete();
            }
            foreach ($cap->accountperformance->accountperformanceBank as $dt) {
                $dt->delete();
            }
            foreach ($cap->accountperformance->accountperformanceUSD as $dt) {
                $dt->delete();
            }

            $cap->accountperformance->delete();
        }

        if($cap->covenants != null && count($cap->covenants) !=0)
        {
            $cap->covenants->delete();
        }
        if($cap->pricingrationale != null && count($cap->pricingrationale) !=0)
        {
            $cap->pricingrationale->delete();
        }
        if($cap->businessactivity != null && count($cap->businessactivity) !=0)
        {
            $cap->businessactivity->delete();
        }
        if($cap->swotanalysis != null && count($cap->swotanalysis) !=0)
        {
            $cap->swotanalysis->delete();
        }
        if($cap->proposedsecurity != null && count($cap->proposedsecurity) !=0)
        {
            $cap->proposedsecurity->delete();
        }
        if($cap->crSignatories != null && count($cap->crSignatories) !=0)
        {
            foreach( $cap->crSignatories as $sg)
            {
                $sg->delete();
            }

        }
        if( $cap->creditRiskGrading !=null && count($cap->creditRiskGrading) >0 )
        {
            $cap->creditRiskGrading->delete();
        }
        if( $cap->financialAnalysis !=null && count($cap->financialAnalysis) !=0 )
        {
            $cap->financialAnalysis->delete();
        }


        $cap->delete();
	}

    //Delete app
    public function destroyApp($id)
    {
        //
        $cap=CreditApp::find($id);

        foreach( $cap->shareholders as $dt)
        {
            $dt->delete();
        }
        foreach( $cap->directors as $dt)
        {
            $dt->delete();
        }
        if( $cap->facilitystructure != null)
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
        foreach( $cap->formstage as $dt)
        {
            $dt->delete();
        }
        foreach( $cap->finalRecommendations as $dt)
        {
            $dt->delete();
        }
        if($cap->accountprofile != null)
        {
            $cap->accountprofile->delete();
        }
        if($cap->accountperformance != null)
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

        if($cap->covenants != null)
        {

             foreach($cap->covenants->pricing as $fr)
             {
                 $fr->delete();
             }
            $cap->covenants->delete();
        }
        if($cap->pricingrationale != null)
        {
            foreach($cap->pricingrationale->details as $fr)
            {
                $fr->delete();
            }

            $cap->pricingrationale->delete();
        }
        if($cap->businessactivity != null)
        {
            $cap->businessactivity->delete();
        }
        if($cap->swotanalysis != null)
        {
            $cap->swotanalysis->delete();
        }
        if($cap->proposedsecurity != null)
        {

             foreach($cap->proposedsecurity->details as $fr)
             {
                 $fr->delete();
             }
            $cap->proposedsecurity->delete();
        }
        if($cap->crSignatories != null)
        {
            $cap->crSignatories->delete();
        }

        if($cap->dscr != null)
        {

            foreach($cap->detail->details as $fr)
            {
                $fr->delete();
            }
            $cap->dscr->delete();
        }
        $cap->delete();

        return redirect('cap-manage');
    }

    public function manage()
    {
        $creditapp= CreditApp::all();
        return view('caproposal.manage',compact('creditapp'));
    }

    public function getByCustomer($id)
    {
        $creditapp= CreditApp::where('customer_id','=',$id)->get();
        return view('caproposal.custapp',compact('creditapp'));
    }

    //Get new Application
    public function newApplications()
    {
        $creditapp= CreditApp::where(\DB::raw('DATEDIFF(sysdate(),created_at)'), '<=', 3)->get();
        return view('caproposal.manage',compact('creditapp'));
    }
    //Get Pending Application
    public function pendingApplications()
    {
        $creditapp= CreditApp::where('autho', '=', 0)->get();
        return view('caproposal.manage',compact('creditapp'));
    }

    //Get Incomplete Application
    public function incompleteApplications()
    {
        $creditapp= CreditApp::where('status', '=', 'incomplete')->get();
        return view('caproposal.manage',compact('creditapp'));
    }

   //Last 24 hours

    public function last24hours()
    {
        $creditapp= CreditApp::where(\DB::raw('HOUR(TIMEDIFF(sysdate(),created_at))'), '>=', 24)->where(\DB::raw('HOUR(TIMEDIFF(sysdate(),created_at))'), '<=', 48)->get();
        return view('caproposal.manage',compact('creditapp'));
    }
    //lastweek
    public function lastweek()
    {
        $creditapp= CreditApp::where(\DB::raw('(HOUR(TIMEDIFF(sysdate(),created_at)))/24'), '=', 7)->get();
        return view('caproposal.manage',compact('creditapp'));
    }

    //Last hours
    public function lasthour()
    {
        $creditapp= CreditApp::where(\DB::raw('HOUR(TIMEDIFF(sysdate(),created_at))'), '<=', 1)->get();
        return view('caproposal.manage',compact('creditapp'));
    }

    public function report($id)
    {
        $cap=CreditApp::find($id);
        return view('pdf.report',compact('cap'));
    }
    public function downloadreport(ReportGenerateRequest $request)
    {
       if(count($request->reportforms) > 0) {
           $crp = CreditApp::find($request->cid);

           $pages = array();

           foreach ($request->reportforms as $sf) {

               switch ($sf) {

                   case "Account profile":
                       $pages[] = view('reports.accountprofile', compact('crp'));
                       break;
                   case "Facility Structure":
                       $pages[] = view('reports.facilitystructure', compact('crp'));
                       break;
                   case "Proposed security":
                       $pages[] = view('reports.Proposedsecurity', compact('crp'));
                       break;
                   case "Covenants":
                       $pages[] = view('reports.Covenants', compact('crp'));
                       break;

                   /*
                    * This section was removed as the pricing rationale form will be available to covenant
                    *  case "Pricing Rationale":
                       $pages[] = view('reports.pricerationaire', compact('crp'));
                       break;
                   */
                   case "Account performance":
                       $pages[] = view('reports.Accountperformance', compact('crp'));
                       break;
                   case "Final recommendations":
                       $pages[] = view('reports.Finalrecommendations', compact('crp'));
                       $pages[] = view('reports.committee', compact('crp'));
                       break;
                   case "Business Activity Review":
                       $pages[] = view('reports.BusinessActivity', compact('crp'));
                       break;
                   case "Environment Review":
                       $pages[] = view('reports.environmentreview', compact('crp'));
                       break;
                   case "Financial Analysis Review":
                       $pages[] = view('reports.financialanalysis', compact('crp'));
                       break;
                   case "Swot Analysis":
                       $pages[] = view('reports.SwotAnalysis', compact('crp'));
                       break;
                   case "Annexure-I":
                       $pages[] = view('reports.annexureI', compact('crp'));
                       break;
                   case "Annexure-II":
                       $pages[] = view('reports.annexureII', compact('crp'));
                       break;
                   case "Credit Risk Grading":
                       $pages[] = view('reports.creditgrading', compact('crp'));
                       break;
               }
           }
           $fo = 'Bank M-Credit Proposal: ' . $crp->ac_name;
           $rep = "Credit-Application-Custom-Report" . strtotime(date("Y-m-d h:m:s")) . ".pdf";
           $pdf = \PDF::loadView('pdf.general', ['pages' => $pages])
               ->setOption('footer-font-size', 7)
               ->setOption('footer-spacing',3 )
               ->setOption('page-size','Letter' )
               ->setOption('title', $fo)
               ->setOption('footer-left', $fo)
               ->setOption('footer-right', 'Page [page]')
               ->setOption('page-offset', 0);


           return $pdf->download($rep);
       } else{return redirect()->back();}

    }
  //Standard report
    public function downloadstreport($id)
    {
        $crp=CreditApp::find($id);

        $pages = array();

        $pages[] =  view('reports.accountprofile',compact('crp'));
        $pages[] = view('reports.facilitystructure',compact('crp'));
        $pages[] = view('reports.Proposedsecurity',compact('crp'));
        $pages[] = view('reports.Covenants',compact('crp'));

        /*
         * This section was removed as the pricing rationale form will be available to covenant
         *  case "Pricing Rationale":
           $pages[] = view('reports.pricerationaire',compact('crp'));
           break;
        */

        $pages[] = view('reports.Accountperformance',compact('crp'));
        $pages[] = view('reports.Finalrecommendations',compact('crp'));
        $pages[] = view('reports.committee',compact('crp'));


        //Footer
        $fo='Bank M-Credit Proposal: '.$crp->ac_name;
        $rep="Credit-Application-Standard-Report".strtotime(date("Y-m-d h:m:s")).".pdf";
        $pdf = \PDF::loadView('pdf.general', ['pages' => $pages])
            ->setOption('footer-font-size', 7 )
            ->setOption('footer-spacing',3 )
            ->setOption('page-size','Letter' )
            ->setOption('title', $fo )
            ->setOption('footer-left', $fo )
            ->setOption('footer-right', 'Page [page]' )
            ->setOption('page-offset', 0 );
        return $pdf->download($rep);


    }


    //Authorization

    public function authorize($id)
    {
        $cap=CreditApp::find($id);

        $msg="Authorization Failed Incomplete Application";
        if (count($cap) != 0 &&  $cap->status !="Incomplete" && $cap->status !="pending")
        {
            $cap->autho=1;
            $cap->save();
            $msg="Application is Successful Authorized";
        }


        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Proposal Application";
        $audit->action="Authorize  Credit Proposal Application for " .$cap->ac_name ." With serial number ".$cap->sno." And ID of ".$cap->id;
        $audit->save();
        return redirect('credit-proposal/'.$id)->with("message",$msg);
    }

    public function authorizemanage($id)
    {
        $cap=CreditApp::find($id);

        $msg="Authorization Failed Incomplete Application ";
        if (count($cap) != 0 &&  $cap->status !="Incomplete" && $cap->status !="pending")
        {
            $cap->autho=1;
            $cap->save();
            $msg="<p> <h1 class='text-danger'>Application is Successful Authorized </h1> </p>";
        }


        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Proposal Application";
        $audit->action="Authorize  Credit Proposal Application for " .$cap->ac_name ." With serial number ".$cap->sno." And ID of ".$cap->id;
        $audit->save();
        return redirect('cap-manage')->with("message",$msg);
    }
}
