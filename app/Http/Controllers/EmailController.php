<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\CreditApp;
use App\User;
use App\Reminder;

class EmailController extends Controller {

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

    //Emails controller
    public function incompleteForms()
    {

        $us = User::all();
        foreach ($us as $u) {
        if(date("H:i") =="09:00") {


                $capp = CreditApp::where('created_by', '=', $u->id)->get();
                if (count($capp) > 0) {
                    $hasIncomplete = "";
                    $msg = view('emails.head',compact('u'));
                    foreach ($capp as $ca) {
                        if (count($ca->accountprofile) == 0 ||
                            count($ca->accountperformance) == 0 ||
                            count($ca->covenants) == 0 ||
                            count($ca->accountperformance) == 0 ||
                            count($ca->finalRecommendations) == 0 ||
                            count($ca->proposedsecurity) == 0 ||
                            count($ca->pricingrationale) == 0
                        ) {

                            //Send email

                            $msg .= "<p>";
                            $msg .= view('emails.incomplete', compact('ca'));
                            $msg .= "</p><br/><br/>";

                            $hasIncomplete = "Yes";
                        }


                    }
                    $msg .= view('emails.footer');
                    $data = array('msg' => $msg);
                    if ($hasIncomplete == "Yes")
                        //Get user details  for sending email
                       //check if reminder was sent


                        if ($u->reminder_sent == 0)
                        {
                        $sent = \Mail::send('emails.echo', $data, function ($message) use ($u) {
                            $email = $u->email;
                            $toName = $u->firstname . " " . $u->lastname;

                            $message->from('bankm.creditportal@bankm.com','Credit Proposal Application');
                            $message->to($email, $toName)->subject('Reminder: Credit Proposal Application(s) with incomplete/missing forms!');
                        });

                       //Reminder Audit
                        $rem=new  Reminder;
                        $rem->user_id=$u->id;
                        $rem->email=$u->email;
                        $rem->send_to=$u->firstname . " " . $u->lastname;
                        $rem->subject="'Reminder: Credit Proposal Application(s) with incomplete/missing forms!";
                        $rem->send_date=date("Y-m-d H:i:s");
                        $rem->contents=$msg;
                        $rem->save();

                            //Update
                             $u->reminder_sent =1;
                             $u->save();
                        }

                }
            }//lu
            else
            {
                $u->reminder_sent =0;
                $u->save();
            }
        }//ou

    }
}
