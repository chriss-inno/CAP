<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Audit;
use Illuminate\Support\Facades\Auth;
use App\LegalEntity;
use App\Http\Requests\LegalEntityRequest;

class LegalEntityController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
    {
        //
        $cm =LegalEntity::all();
        return view('legal-entity.index',compact('cm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('legal-entity.create');
    }
    //Manage
    public function manage()
    {
        //
        return view('legal-entity.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(LegalEntityRequest $request)
    {
        //
        $ce=new LegalEntity;
        $ce->entity=$request->entity;
        $ce->descriptions=$request->descriptions;
        $ce->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Director Credit Commmittee";
        $audit->action="Director Credit Commmittee member with  firstname" .$ce->firstname ." and surname" .$ce->surname;
        $audit->save();

        return redirect('legal-entity');
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
        $cm= LegalEntity::find($id);
        return view('legal-entity.edit',compact('cm'));
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
        $cm =LegalEntity::find($id);
        return view('legal-entity.edit',compact('cm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(LegalEntityRequest $request)
    {
        //
        $ce= LegalEntity::find($request->id);
        $ce->entity=$request->entity;
        $ce->descriptions=$request->descriptions;
        $ce->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Committee";
        $audit->action="Update legal Entity with  firstname" .$ce->entity ." and id" .$ce->id;
        $audit->save();
        $cm =LegalEntity::all();

        return redirect('legal-entity');

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
        $ce= LegalEntity::find($id);

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="legal Entity";
        $audit->action="Removed legal Entity with entity" .$ce->entity ." and id" .$ce->id;
        $audit->save();

        $ce->delete();

        return redirect('legal-entity');

    }

}
