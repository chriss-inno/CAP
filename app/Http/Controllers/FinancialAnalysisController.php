<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\FinancialAnalysisRequest;
use App\Sale;
use App\Profitability;
use App\Gearing;
use App\DSCR;
use App\Creditors;
use App\Debtor;
use App\Liquidity;
use App\Worth;
use App\FormStage;
use Illuminate\Support\Facades\Auth;
use App\Audit;
use App\FinancialAnalysis;
use App\SalesDetail;
use App\ProfitabilityDetail;
use App\GearingDetail;
use App\DSCRDetail;
use App\CreditorsDetail;
use App\DebtorsDetail;
use App\LiquidityDetail;
use App\WorthDetail;
use App\CreditApp;

class FinancialAnalysisController extends Controller {

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
	public function store(FinancialAnalysisRequest $request)
	{
		//
        if($request->apprequest == 0)
        {

            $fa=new FinancialAnalysis;
            $fa->crp_id=$request->crp_id;
            $fa->save();

            $completed=25;

            //Process Sales
            $sale=new Sale;
            $sale->fa_id=$fa->id;
            if($request->d_date1 !="")$sale->date_1=date("d.m.Y",strtotime($request->d_date1));
            if($request->d_date2 !="")$sale->date_2=date("d.m.Y",strtotime($request->d_date2));
            if($request->d_date3 !="") $sale->date_3=date("d.m.Y",strtotime($request->d_date3));
            $sale->comments=$request->d_comment;
            $sale->save();
            //Process sales details
            $d1=$request->d1;
            $d2=$request->d2;
            $d3=$request->d3;
            $d4=$request->d4;

            for($i=0; $i<count($d1); $i++)
            {
                if($d1[$i] !="" ||$d2[$i] !="" || $d3[$i] !="" || $d4[$i] !="")
                {
                    $salesdetail =new SalesDetail;
                    $salesdetail->sale_id =$sale->id;
                    $salesdetail->data_1=$d1[$i];
                    $salesdetail->data_2=$d2[$i];
                    $salesdetail->data_3=$d3[$i];
                    $salesdetail->data_4=$d4[$i];
                    $salesdetail->save();

                    $completed=35;
                }
            }

            //Process Profitability
            $profitability=new Profitability;
            $profitability->fa_id=$fa->id;
            if($request->pr_date1 !="")$profitability->date_1=date("d.m.Y",strtotime($request->pr_date1));
            if($request->pr_date2 !="") $profitability->date_2=date("d.m.Y",strtotime($request->pr_date2));
            if($request->pr_date3 !="")$profitability->date_3=date("d.m.Y",strtotime($request->pr_date3));
            $profitability->comments=$request->pr_comment;
            $profitability->save();

            //Process Profitability details
            $pr1=$request->pr1;
            $pr2=$request->pr2;
            $pr3=$request->pr3;
            $pr4=$request->pr4;

            for($i=0; $i<count($pr1); $i++)
            {
                if($pr1[$i] !="" ||$pr2[$i] !="" || $pr3[$i] !="" || $pr4[$i] !="" )
                {
                    $ProfitabilityDetail=new ProfitabilityDetail;
                    $ProfitabilityDetail->pf_id=$profitability->id;
                    $ProfitabilityDetail->data_1=$pr1[$i];
                    $ProfitabilityDetail->data_2=$pr2[$i];
                    $ProfitabilityDetail->data_3=$pr3[$i];
                    $ProfitabilityDetail->data_4=$pr4[$i];
                    $ProfitabilityDetail->save();

                    $completed=45;
                }
            }

            //3. Process Gearing

            $gearing=new Gearing;
            $gearing->fa_id=$fa->id;
            if($request->g_date1 !="")$gearing->date_1=date("d.m.Y",strtotime($request->g_date1));
            if($request->g_date2 !="")$gearing->date_2=date("d.m.Y",strtotime($request->g_date2));
            if($request->g_date3 !="")$gearing->date_3=date("d.m.Y",strtotime($request->g_date3));
            $gearing->comments=$request->g_comment;
            $gearing->save();

            //Process Gearing details
            $ge1=$request->ge1;
            $ge2=$request->ge2;
            $ge3=$request->ge3;
            $ge4=$request->ge4;

            for($i=0; $i<count($ge1); $i++)
            {
                if($ge1[$i] !="" ||$ge2[$i] !="" || $ge3[$i] !="" || $ge4[$i] !="" )
                {
                    $gearingDetail=new GearingDetail;
                    $gearingDetail->gearings_id=$gearing->id;
                    $gearingDetail->data_1=$ge1[$i];
                    $gearingDetail->data_2=$ge2[$i];
                    $gearingDetail->data_3=$ge3[$i];
                    $gearingDetail->data_4=$ge4[$i];
                    $gearingDetail->save();

                    $completed=55;
                }
            }

            //Process DSCR
            $dscr=new DSCR;
            $dscr->fa_id=$fa->id;
            if($request->dscr_date1 !="")$dscr->date_1=date("d.m.Y",strtotime($request->dscr_date1));
            if($request->dscr_date2 !="")$dscr->date_2=date("d.m.Y",strtotime($request->dscr_date2));
            if($request->dscr_date3 !="") $dscr->date_3=date("d.m.Y",strtotime($request->dscr_date3));
            $dscr->comments=$request->dscr_comment;
            $dscr->save();

            //Process DSCR DEtails
            for($i=0; $i<count($request->DSCR1); $i++)
            {
                if($request->DSCR1[$i] !="" ||$request->DSCR2[$i] !="" || $request->DSCR3[$i] !="" || $request->DSCR4[$i] !="" )
                {
                    $DSCRDetail=new DSCRDetail;
                    $DSCRDetail->ds_id=$dscr->id;
                    $DSCRDetail->data_1=$request->DSCR1[$i];
                    $DSCRDetail->data_3=$request->DSCR2[$i];
                    $DSCRDetail->data_4=$request->DSCR3[$i];
                    $DSCRDetail->data_2=$request->DSCR4[$i];
                    $DSCRDetail->save();

                    $completed=65;
                }
            }

            //Process Creditors
            $creditors=new Creditors;
            $creditors->fa_id=$fa->id;
            if($request->ce_date1 !="") $creditors->date_1=date("d.m.Y",strtotime($request->ce_date1));
            if($request->ce_date2 !="") $creditors->date_2=date("d.m.Y",strtotime($request->ce_date2));
            if($request->ce_date3 !="") $creditors->date_3=date("d.m.Y",strtotime($request->ce_date3));
            $creditors->comments=$request->ce_comment;
            $creditors->save();

            //Process Creitor Details
            for($i=0; $i<count($request->ce1); $i++)
            {
                if($request->ce1[$i] !="" ||$request->ce2[$i] !="" || $request->ce3[$i] !="" || $request->ce4[$i] !="" )
                {
                    $creditorsDetail=new CreditorsDetail;
                    $creditorsDetail->creditor_id=$creditors->id;
                    $creditorsDetail->data_1=$request->ce1[$i];
                    $creditorsDetail->data_2=$request->ce2[$i];
                    $creditorsDetail->data_3=$request->ce3[$i];
                    $creditorsDetail->data_4=$request->ce4[$i];
                    $creditorsDetail->save();

                    $completed=75;
                }
            }

            //Deptor

            $Debtor=new Debtor;
            $Debtor->fa_id=$fa->id;
            if($request->de_date1 !="")$Debtor->date_1=date("d.m.Y",strtotime($request->de_date1));
            if($request->de_date2 !="")$Debtor->date_2=date("d.m.Y",strtotime($request->de_date2));
            if($request->de_date3 !="") $Debtor->date_3=date("d.m.Y",strtotime($request->de_date3));
            $Debtor->comments=$request->de_comment;
            $Debtor->save();

            //Process deptor details
            for($i=0; $i<count($request->de1); $i++)
            {
                if($request->de1[$i] !="" ||$request->de2[$i] !="" || $request->de3[$i] !="" || $request->de4[$i] !="" )
                {
                    $debtorsDetail=new debtorsDetail;
                    $debtorsDetail->deditor_id=$Debtor->id;
                    $debtorsDetail->data_1=$request->de1[$i];
                    $debtorsDetail->data_2=$request->de2[$i];
                    $debtorsDetail->data_3=$request->de3[$i];
                    $debtorsDetail->data_4=$request->de4[$i];
                    $debtorsDetail->save();

                    $completed=85;
                }
            }
            //Process Liquidity
            $liquidity=new Liquidity;
            $liquidity->fa_id=$fa->id;
            if($request->li_date1 !="")$liquidity->date_1=date("d.m.Y",strtotime($request->li_date1));
            if($request->li_date2 !="")$liquidity->date_2=date("d.m.Y",strtotime($request->li_date2));
            if($request->li_date3 !="")$liquidity->date_3=date("d.m.Y",strtotime($request->li_date3));
            $liquidity->comments=$request->li_comment;
            $liquidity->save();

            //Process Liquidity details
            for($i=0; $i<count($request->l1); $i++)
            {
                if($request->l1[$i] !="" ||$request->l2[$i] !="" || $request->l3[$i] !="" || $request->l4[$i] !="" )
                {
                    $liquidityDetail=new LiquidityDetail;
                    $liquidityDetail->liquidity_id=$liquidity->id;
                    $liquidityDetail->data_1=$request->l1[$i];
                    $liquidityDetail->data_2=$request->l2[$i];
                    $liquidityDetail->data_3=$request->l3[$i];
                    $liquidityDetail->data_4=$request->l4[$i];
                    $liquidityDetail->save();

                    $completed=85;
                }
            }

            //Process Tangible Net Worth
            $worth=new Worth;
            $worth->fa_id=$fa->id;
            if($request->w_date1 !="")$worth->date_1=date("d.m.Y",strtotime($request->w_date1));
            if($request->w_date2 !="")$worth->date_2=date("d.m.Y",strtotime($request->w_date2));
            if($request->w_date3 !="") $worth->date_3=date("d.m.Y",strtotime($request->w_date3));
            $worth->comments=$request->w_comment;
            $worth->save();

            for($i=0; $i<count($request->w1); $i++)
            {
                if($request->w1[$i] !="" ||$request->w2[$i] !="" || $request->w3[$i] !="" || $request->w4[$i] !="" )
                {
                    $worthDetail=new WorthDetail;
                    $worthDetail->worth_id=$worth->id;
                    $worthDetail->data_1=$request->w1[$i];
                    $worthDetail->data_2=$request->w2[$i];
                    $worthDetail->data_3=$request->w3[$i];
                    $worthDetail->data_4=$request->w4[$i];
                    $worthDetail->save();

                    $completed=100;
                }
            }


            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Financial Analysis Review')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Create  Financial Analysis Review form  for Application  " .$cr->ac_name;
            $audit->save();
        }
        else
        {


            $fa= FinancialAnalysis::find($request->id);
            $fa->crp_id=$request->crp_id;
            $fa->save();

            $completed=25;

            //Process Sales
            $sale=Sale::where('fa_id','=',$fa->id)->first();;
            $sale->fa_id=$fa->id;
            if($request->d_date1 !="")$sale->date_1=date("d.m.Y",strtotime($request->d_date1));
            if($request->d_date2 !="")$sale->date_2=date("d.m.Y",strtotime($request->d_date2));
            if($request->d_date3 !="")$sale->date_3=date("d.m.Y",strtotime($request->d_date3));
            $sale->comments=$request->d_comment;
            $sale->save();

            //Process sales details

            $sd=SalesDetail::where('sale_id','=',$sale->id)->delete();

            $d1=$request->d1;
            $d2=$request->d2;
            $d3=$request->d3;
            $d4=$request->d4;

            for($i=0; $i<count($d1); $i++)
            {
                if($d1[$i] !="" ||$d2[$i] !="" || $d3[$i] !="" || $d4[$i] !="")
                {
                    $salesdetail =new SalesDetail;
                    $salesdetail->sale_id =$sale->id;
                    $salesdetail->data_1=$d1[$i];
                    $salesdetail->data_2=$d2[$i];
                    $salesdetail->data_3=$d3[$i];
                    $salesdetail->data_4=$d4[$i];
                    $salesdetail->save();

                    $completed=35;
                }
            }

            //Process Profitability
            $profitability= Profitability::where('fa_id','=',$fa->id)->first();;

            $profitability->fa_id=$fa->id;
            if($request->pr_date1 !="")$profitability->date_1=date("d.m.Y",strtotime($request->pr_date1));
            if($request->pr_date2 !="")$profitability->date_2=date("d.m.Y",strtotime($request->pr_date2));
            if($request->pr_date3 !="")$profitability->date_3=date("d.m.Y",strtotime($request->pr_date3));
            $profitability->comments=$request->pr_comment;
            $profitability->save();

            //Process Profitability details
            $sd=ProfitabilityDetail::where('pf_id','=',$profitability->id)->delete();
            $pr1=$request->pr1;
            $pr2=$request->pr2;
            $pr3=$request->pr3;
            $pr4=$request->pr4;



            for($i=0; $i<count($pr1); $i++)
            {

                if($pr1[$i] !="" ||$pr2[$i] !="" || $pr3[$i] !="" || $pr4[$i] !="" )
                {
                    $ProfitabilityDetail=new ProfitabilityDetail;
                    $ProfitabilityDetail->pf_id=$profitability->id;
                    $ProfitabilityDetail->data_1=$pr1[$i];
                    $ProfitabilityDetail->data_2=$pr2[$i];
                    $ProfitabilityDetail->data_3=$pr3[$i];
                    $ProfitabilityDetail->data_4=$pr4[$i];
                    $ProfitabilityDetail->save();

                    $completed=45;

                }

            }

            //3. Process Gearing

            $gearing= Gearing::where('fa_id','=',$fa->id)->first();;

            $gearing->fa_id=$fa->id;
            if($request->g_date1 !="")$gearing->date_1=date("d.m.Y",strtotime($request->g_date1));
            if($request->g_date2 !="")$gearing->date_2=date("d.m.Y",strtotime($request->g_date2));
            if($request->g_date3 !="")$gearing->date_3=date("d.m.Y",strtotime($request->g_date3));
            $gearing->comments=$request->g_comment;
            $gearing->save();

            //Process Gearing details
            $sd=GearingDetail::where('gearings_id','=',$gearing->id)->delete();
            $ge1=$request->ge1;
            $ge2=$request->ge2;
            $ge3=$request->ge3;
            $ge4=$request->ge4;

            for($i=0; $i<count($ge1); $i++)
            {
                if($ge1[$i] !="" ||$ge2[$i] !="" || $ge3[$i] !="" || $ge4[$i] !="" )
                {
                    $gearingDetail=new GearingDetail;
                    $gearingDetail->gearings_id=$gearing->id;
                    $gearingDetail->data_1=$ge1[$i];
                    $gearingDetail->data_2=$ge2[$i];
                    $gearingDetail->data_3=$ge3[$i];
                    $gearingDetail->data_4=$ge4[$i];
                    $gearingDetail->save();

                    $completed=55;
                }
            }

            //Process DSCR
            $dscr= DSCR::where('fa_id','=',$fa->id)->first();

            $dscr->fa_id=$fa->id;
            if($request->dscr_date1 !="")$dscr->date_1=date("d.m.Y",strtotime($request->dscr_date1));
            if($request->dscr_date2 !="")$dscr->date_2=date("d.m.Y",strtotime($request->dscr_date2));
            if($request->dscr_date3 !="") $dscr->date_3=date("d.m.Y",strtotime($request->dscr_date3));
            $dscr->comments=$request->dscr_comment;
                $dscr->save();

            //Process DSCR DEtails
            $sd=DSCRDetail::where('ds_id','=',$dscr->id)->delete();
            for($i=0; $i<count($request->DSCR1); $i++)
            {
                if($request->DSCR1[$i] !="" ||$request->DSCR2[$i] !="" || $request->DSCR3[$i] !="" || $request->DSCR4[$i] !="" )
                {
                    $DSCRDetail=new DSCRDetail;
                    $DSCRDetail->ds_id=$dscr->id;
                    $DSCRDetail->data_1=$request->DSCR1[$i];
                    $DSCRDetail->data_2=$request->DSCR2[$i];
                    $DSCRDetail->data_3=$request->DSCR3[$i];
                    $DSCRDetail->data_4=$request->DSCR4[$i];
                    $DSCRDetail->save();

                    $completed=65;
                }
            }

            //Process Creditors
            $creditors= Creditors::where('fa_id','=',$fa->id)->first();;
            $creditors->fa_id=$fa->id;
            if($request->ce_date1 !="") $creditors->date_1=date("d.m.Y",strtotime($request->ce_date1));
            if($request->ce_date2 !="")$creditors->date_2=date("d.m.Y",strtotime($request->ce_date2));
            if($request->ce_date3 !="")$creditors->date_3=date("d.m.Y",strtotime($request->ce_date3));
            $creditors->comments=$request->ce_comment;
            $creditors->save();

            //Process Creitor Details
            $sd=CreditorsDetail::where('creditor_id','=',$creditors->id)->delete();
            for($i=0; $i<count($request->ce1); $i++)
            {
                if($request->ce1[$i] !="" ||$request->ce2[$i] !="" || $request->ce3[$i] !="" || $request->ce4[$i] !="" )
                {
                    $creditorsDetail=new CreditorsDetail;
                    $creditorsDetail->creditor_id=$creditors->id;
                    $creditorsDetail->data_1=$request->ce1[$i];
                    $creditorsDetail->data_2=$request->ce2[$i];
                    $creditorsDetail->data_3=$request->ce3[$i];
                    $creditorsDetail->data_4=$request->ce4[$i];
                    $creditorsDetail->save();

                    $completed=75;
                }
            }

            //Deptor

            $Debtor= Debtor::where('fa_id','=',$fa->id)->first();;
            $Debtor->fa_id=$fa->id;
            if($request->de_date1 !="")$Debtor->date_1=date("d.m.Y",strtotime($request->de_date1));
            if($request->de_date2 !="") $Debtor->date_2=date("d.m.Y",strtotime($request->de_date2));
            if($request->de_date3 !="") $Debtor->date_3=date("d.m.Y",strtotime($request->de_date3));
            $Debtor->comments=$request->de_comment;
            $Debtor->save();

            //Process deptor details
            $sd=DebtorsDetail::where('deditor_id','=',$Debtor->id)->delete();
            for($i=0; $i<count($request->de1); $i++)
            {
                if($request->de1[$i] !="" ||$request->de2[$i] !="" || $request->de3[$i] !="" || $request->de4[$i] !="" )
                {
                    $debtorsDetail=new DebtorsDetail;
                    $debtorsDetail->deditor_id=$Debtor->id;
                    $debtorsDetail->data_1=$request->de1[$i];
                    $debtorsDetail->data_2=$request->de2[$i];
                    $debtorsDetail->data_3=$request->de3[$i];
                    $debtorsDetail->data_4=$request->de4[$i];
                    $debtorsDetail->save();

                    $completed=85;
                }
            }
            //Process Liquidity
            $liquidity= Liquidity::where('fa_id','=',$fa->id)->first();;

            $liquidity->fa_id=$fa->id;
            if($request->li_date1 !="")$liquidity->date_1=date("d.m.Y",strtotime($request->li_date1));
            if($request->li_date2 !="")$liquidity->date_2=date("d.m.Y",strtotime($request->li_date2));
            if($request->li_date3 !="")$liquidity->date_3=date("d.m.Y",strtotime($request->li_date3));
            $liquidity->comments=$request->li_comment;
            $liquidity->save();

            //Process Liquidity details
            $sd=LiquidityDetail::where('liquidity_id','=',$liquidity->id)->delete();
            for($i=0; $i<count($request->l1); $i++)
            {
                if($request->l1[$i] !="" ||$request->l2[$i] !="" || $request->l3[$i] !="" || $request->l4[$i] !="" )
                {
                    $liquidityDetail=new LiquidityDetail;
                    $liquidityDetail->liquidity_id=$liquidity->id;
                    $liquidityDetail->data_1=$request->l1[$i];
                    $liquidityDetail->data_2=$request->l2[$i];
                    $liquidityDetail->data_3=$request->l3[$i];
                    $liquidityDetail->data_4=$request->l4[$i];
                    $liquidityDetail->save();

                    $completed=85;
                }
            }

            //Process Tangible Net Worth
            $worth= Worth::where('fa_id','=',$fa->id)->first();;

            $worth->fa_id=$fa->id;
            if($request->w_date1 !="")$worth->date_1=date("d.m.Y",strtotime($request->w_date1));
            if($request->w_date2 !="") $worth->date_2=date("d.m.Y",strtotime($request->w_date2));
            if($request->w_date3 !="") $worth->date_3=date("d.m.Y",strtotime($request->w_date3));
            $worth->comments=$request->w_comment;
            $worth->save();

            $sd=WorthDetail::where('worth_id','=',$worth->id)->delete();

            for($i=0; $i<count($request->w1); $i++)
            {
                if($request->w1[$i] !="" ||$request->w2[$i] !="" || $request->w3[$i] !="" || $request->w4[$i] !="" )
                {
                    $worthDetail=new WorthDetail;
                    $worthDetail->worth_id=$worth->id;
                    $worthDetail->data_1=$request->w1[$i];
                    $worthDetail->data_2=$request->w2[$i];
                    $worthDetail->data_3=$request->w3[$i];
                    $worthDetail->data_4=$request->w4[$i];
                    $worthDetail->save();

                    $completed=100;
                }
            }


            //Process form stages
            $formStage = FormStage::where('crp_id','=',$request->crp_id)->where('stage_name','=','Financial Analysis Review')->first();
            $formStage->crp_id=$request->crp_id;
            $formStage->completed=$completed;
            $formStage->save();

            //Process Audits
            $cr=CreditApp::find($request->crp_id)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update Financial Analysis Review form for Application  " .$cr->ac_name;
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
