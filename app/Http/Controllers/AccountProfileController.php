<?php namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\Apprequest;
use App\AccountProfile;
use App\FormStage;
use App\CreditApp;
use App\Audit;
use Illuminate\Support\Facades\Auth;
use App\CurrentBankers;
class AccountProfileController extends Controller {

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
	public function store( Apprequest  $request)
	{
		//
       //Check request type

        if( $request->apprequest ==0) //create new profile
        {

            $usp=new AccountProfile;
            $usp->business_activity = $request->business_activity;
            $usp->legal_entity = $request->legal_entity;

            $usp->credit_rating = $request->credit_rating;
            $usp->borrowerid = $request->borrowerid;

            $usp->emanagement=$request->emanagement;
            $usp->g_indicator = $request->g_indicator;

            $usp->app_group = $request->group;
            $usp->customer_id=$request->crid;
            $usp->save();

            $CreditApp =CreditApp::find($request->crid);
            $CreditApp->current_stage = 1;
            $CreditApp->save();

            $directors=$request->directors;
            $shareholders=$request->shareholders;
            $holdings=$request->holdings;
            $id=$request->crid;

            //Form  stage
            $completed=25;


            //Insert directors
            foreach($directors as $director)
            {
               if($director !="")
               {
                   $cairectors=new \App\CADirectors;
                   $cairectors->customer_id=$request->crid;
                   $cairectors->fullname=$director;
                   $cairectors->save();
               }


                $completed=50;
            }
            //Insert into share holders

            for($i=0; $i<sizeof($shareholders); $i++)
            {
                if($shareholders[$i] != "" && $shareholders[$i] !=null)
                {
                    $cashareholders = new \App\CAShareholders;
                    $cashareholders->customer_id = $request->crid;
                    $cashareholders->name = $shareholders[$i];
                    $cashareholders->holding = $holdings[$i];
                    $cashareholders->save();

                    $completed=75;
                }
            }

            //Insert current bankers
            foreach($request->cr_bankers as $cb)
            {
                if($cb !="")
                {
                    $currentBankers =new CurrentBankers;
                    $currentBankers->customer_id=$request->crid;
                    $currentBankers->bankname=$cb;
                    $currentBankers->save();
                }

                $completed=100;
            }




            //Process Audits
            $cr=Customer::find($request->crid)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Created  Account profile form  for Customer  " .$cr->customer-name;
            $audit->save();
        }
        else {
            $usp = AccountProfile::find($request->id);

            $usp->business_activity = $request->business_activity;
            $usp->legal_entity = $request->legal_entity;

            $usp->credit_rating = $request->credit_rating;
            $usp->borrowerid = $request->borrowerid;

            $usp->emanagement=$request->emanagement;
            $usp->g_indicator = $request->g_indicator;

            $usp->app_group = $request->group;
            $usp->customer_id=$request->crid;

            $usp->save();


            $CreditApp =CreditApp::find($request->crid);
            $CreditApp->current_stage = 1;
            $CreditApp->save();


            $directors=$request->directors;
            $shareholders=$request->shareholders;
            $holdings=$request->holdings;
            $id=$request->crid;

            //Form  stage
            $completed=25;

            $cadr= \App\CADirectors::where('customer_id','=',$request->crid)->delete();

            //Insert directors
            foreach($directors as $director)
            {
               if($director !="")
               {
                   $cairectors=new \App\CADirectors;
                   $cairectors->customer_id=$request->crid;
                   $cairectors->fullname=$director;
                   $cairectors->save();
               }


                $completed=50;
            }
            //Insert into share holders
            $casr= \App\CAShareholders::where('customer_id','=',$request->crid)->delete();


            for($i=0; $i<sizeof($shareholders); $i++)
            {
                if($shareholders[$i] != "" && $shareholders[$i] !=null)
                {
                    $cashareholders = new \App\CAShareholders;
                    $cashareholders->customer_id = $request->crid;
                    $cashareholders->name = $shareholders[$i];
                    $cashareholders->holding = $holdings[$i];
                    $cashareholders->save();

                    $completed=75;
                }
            }

            //Insert current bankers
            $cabr= \App\CurrentBankers::where('customer_id','=',$id)->delete();


            foreach($request->cr_bankers as $cb)
            {
               if($cb !="")
               {
                   $currentBankers =new CurrentBankers;
                   $currentBankers->customer_id=$id;
                   $currentBankers->bankname=$cb;
                   $currentBankers->save();
               }

                $completed=100;
            }


            //Process Audits
            $cr=Customer::find($request->crid)->first();
            $audit=new Audit;
            $audit->user_id =Auth::user()->id;
            $audit->module="Credit Proposal Application";
            $audit->action="Update  Account profile form  for Customer  " .$cr->customer_name;
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
