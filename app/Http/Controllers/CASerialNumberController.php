<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \App\CASerialNumber;
use Illuminate\Http\Request;
use App\Http\Requests\CASerialNumberRequest;

class CASerialNumberController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Show serial number
        $snos=0;
        if(count(CASerialNumber::all()) > 0)
        {
            $snos= CASerialNumber::all()->first()->startno;
        }


        return view('serialno.setserialno',compact('snos'));
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
	public function store(CASerialNumberRequest $request)
	{
		//
        if(count(CASerialNumber::all()) > 0)
        {


            $csaerialNumber=CASerialNumber::all()->first();
            $csaerialNumber->startno= $request->serial_no;
            $csaerialNumber->save();
        }
        else
        {
            $csaerialNumber=new CASerialNumber;;
            $csaerialNumber->startno= 1;
            $csaerialNumber->save();
        }



        return redirect('serialno');
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
