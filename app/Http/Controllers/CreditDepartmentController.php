<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\CreditDepartmentSetting;
use App\Http\Requests\CreditDepartmentRequest;
use App\Audit;
use Illuminate\Support\Facades\Auth;

class CreditDepartmentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $dp=CreditDepartmentSetting::all()->first();
        return view('department.index',compact('dp'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('department.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreditDepartmentRequest $request)
	{
		//
        $dp=new CreditDepartmentSetting;
        $dp->dpt_head=$request->dpt_head;
        $dp->dpt_analyst=$request->dpt_analyst;
        $dp->dpt_chief=$request->dpt_chief;
        $dp->app_limit=$request->app_limit;
        $dp->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Department";
        $audit->action="Create Credit Department Setting  with  Head Credit Riskk" .$dp->dpt_head ." and Credit Analyst" . $dp->dpt_analyst. " and Chief Credit Officer". $dp->dpt_chief;
        $audit->save();

        return redirect('department');

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
        $dp=CreditDepartmentSetting::all();
        return view('department.index',compact('dp'));
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
        $dp=CreditDepartmentSetting::find($id);
        return view('department.edit',compact('dp'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CreditDepartmentRequest $request)
	{
		//
        $dp= CreditDepartmentSetting::find($request->id);
        $dp->dpt_head=$request->dpt_head;
        $dp->dpt_analyst=$request->dpt_analyst;
        $dp->dpt_chief=$request->dpt_chief;
        $dp->app_limit=$request->app_limit;
        $dp->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Department";
        $audit->action="Update Credit Department Setting  with  Head Credit Riskk " .$dp->dpt_head ." and Credit Analyst " . $dp->dpt_analyst. " and Chief Credit Officer ". $dp->dpt_chief;
        $audit->save();

        return redirect('department');

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
        $dp=CreditDepartmentSetting::find($id);

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Credit Department";
        $audit->action="Removed Credit Department Setting  with  Head Credit Riskk" .$dp->dpt_head ." and Credit Analyst" . $dp->dpt_analyst. " and Chief Credit Officer". $dp->dpt_chief;
        $audit->save();
  //P
        $dp->delete();

        return redirect('department');
	}

}
