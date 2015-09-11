<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\DirectorCommmitteeRequest;
use App\DirectorCommmittee;
use App\Audit;
use Illuminate\Support\Facades\Auth;

class DirectorCommmitteeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
    {
        //
        $cm =DirectorCommmittee::all();
        return view('directors.index',compact('cm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('directors.create');
    }
    //Manage
    public function manage()
    {
        //
        return view('directors.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(DirectorCommmitteeRequest $request)
    {
        //
        $ce=new DirectorCommmittee;
        $ce->firstname=$request->firstname;

        $ce->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Director Credit Commmittee";
        $audit->action="Director Credit Commmittee member with  Full Name" .$ce->firstname ;
        $audit->save();

        return redirect('directors');
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
        $cm= DirectorCommmittee::find($id);
        return view('directors.edit',compact('cm'));
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
        $cm =DirectorCommmittee::find($id);
        return view('directors.edit',compact('cm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(DirectorCommmitteeRequest $request)
    {
        //
        $ce= DirectorCommmittee::find($request->id);
        $ce->firstname=$request->firstname;
        $ce->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Committee";
        $audit->action="Update Credit management committee member with  Full Name" .$ce->firstname ;
        $audit->save();
        $cm =DirectorCommmittee::all();

        return redirect('directors');

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
        $ce= DirectorCommmittee::find($id);

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Director Credit Committee";
        $audit->action="Removed Director Credit management committee member with  Full Name" .$ce->firstname;
        $audit->save();

        $ce->delete();

        return redirect('directors');

    }

}
