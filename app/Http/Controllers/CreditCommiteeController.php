<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CreditCommitee;
use Illuminate\Http\Request;
use App\Http\Requests\CommitteeRequest;
use App\Audit;
use Illuminate\Support\Facades\Auth;

class CreditCommiteeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $cm =CreditCommitee::all();
       return view('committee.index',compact('cm'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('committee.create');
	}
    //Manage
    public function manage()
    {
        //
        return view('committee.create');
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CommitteeRequest $request)
	{
		//
        $ce=new CreditCommitee;
        $ce->firstname=$request->firstname;
        $ce->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Committee";
        $audit->action="Create Credit management committee member with  Full Name " .$ce->firstname ;
        $audit->save();

        return redirect('committee');
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
        $cm= CreditCommitee::find($id);
        return view('committee.edit',compact('cm'));
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
        $cm =CreditCommitee::find($id);
        return view('committee.edit',compact('cm'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CommitteeRequest $request)
	{
		//
        $ce= CreditCommitee::find($request->id);
        $ce->firstname=$request->firstname;
        $ce->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Committee";
        $audit->action="Update Credit management committee member with  firstname" .$ce->firstname ." and surname" .$ce->surname;
        $audit->save();
        $cm =CreditCommitee::all();

        return redirect('committee');

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
        $ce= CreditCommitee::find($id);

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Committee";
        $audit->action="Removed Credit management committee member with  Full name" .$ce->firstname;
        $audit->save();

        $ce->delete();

        return redirect('committee');

	}

}
