<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Currency;
use Illuminate\Support\Facades\Auth;
use App\Audit;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $ccy=Currency::all();
        return view('currency.index',compact('ccy'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('currency.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CurrencyRequest $request)
	{
		//
        $currency=new Currency;
        $currency->ccy=strtoupper($request->ccy);
        $currency->base_rate=$request->base_rate;
        $currency->is_default=$request->is_default;
        $currency->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Currency";
        $audit->action="Added Currency  Currency name" . $currency->ccy ." base_rate". $currency->base_rate . " is_default".$currency->is_default;
        $audit->save();

        $ccy=Currency::all();
        return view('currency.index',compact('ccy'));

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
        $currency=Currency::find($id);
        return view('currency.edit',compact('currency'));
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
        $currency=Currency::find($id);
        return view('currency.edit',compact('currency'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CurrencyRequest $request)
	{
		//
        $currency= Currency::find($request->id);
        $currency->ccy=$request->ccy;
        $currency->base_rate=$request->base_rate;
        $currency->is_default=$request->is_default;
        $currency->save();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Currency";
        $audit->action="Added Currency  Currency name" . $currency->ccy ." base_rate". $currency->base_rate . " is_default".$currency->is_default;
        $audit->save();
        return  redirect('currency');
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
        $currency= Currency::find($id);

        $currency->delete();

        //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module="Currency";
        $audit->action="Removed  Currency  Currency name" . $currency->ccy ." base_rate". $currency->base_rate . " is_default".$currency->is_default;
        $audit->save();
        return  redirect('currency');
	}
    public static function isBaseCurrency($ccy)
    {
        $usr=Currency::where('ccy','=',$ccy)->get()->first();
        if(count($usr)>0 && $usr->is_default=="Yes") {
            return true;} else {return false;}
    }
    public static function isNotBaseCurrency($ccy)
    {
        $usr=Currency::where('ccy','=',$ccy)->get()->first();
        if(count($usr)>0 && $usr->is_default !="Yes") {
            return true;} else {return false;}
    }



}
