<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerRequest;
use App\Audit;
use App\CustomerSignatory;

class CustomerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
         $customers=Customer::all();
		return view('customer.index',compact('customers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return view('customer.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CustomerRequest $request)
	{
		//
		$cust=new Customer;
		$cust->customer_name=$request->customer_name;
		$cust->customer_address=$request->customer_address;
		$cust->contact_person=$request->contact_person;
		$cust->rm=$request->rm;
		$cust->created_by= Auth::user()->id;
		$cust->save();

		//Prepare customer no
		 $cust->customer_no=$cust->id.date('Y').'CUST'.date('d').date('m');
		$cust->save();
		//Process Signatories
		if(count($request->sigscheck) > 0)
		{
			foreach ($request->sigscheck as $sigs)
			{
				$siarr = explode('###', $sigs);
				$sigapp = new CustomerSignatory;
				$sigapp->customer_id = $cust->id;
				$sigapp->names = $siarr[0];
				$sigapp->designation = $siarr[1];
				$sigapp->save();
			}
		}

		//Process Audits
		$audit=new Audit;
		$audit->user_id =Auth::user()->id;
		$audit->module="Customers";
		$audit->action="Created new customer with customer_name ".$request->customer_name." Address " . $request->customer_address."  and customer ID " .$cust->id;
		$audit->save();
         return redirect('customers');
		//return "Request saved successful";
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
		$customer=Customer::find($id);
		return view('customer.show',compact('customer'));
	}
	public function showProfile($id)
	{
		//
		$customer=Customer::find($id);
		return view('customer.accountprofile',compact('customer'));
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
		$customer=Customer::find($id);
		return view('customer.edit',compact('customer'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(CustomerRequest $request)
	{
		//
		$cust=Customer::find($request->customer_id);
		$cust->customer_name=$request->customer_name;
		$cust->customer_address=$request->customer_address;
		$cust->contact_person=$request->contact_person;
		$cust->rm=$request->rm;
		$cust->created_by= Auth::user()->id;
		$cust->save();

		if(count($cust->Signatories) > 0)
			foreach($cust->Signatories as $sg)
			{
				$sg->delete();
			}
		//Process Signatories
		if(count($request->sigscheck) > 0)
		{
			foreach ($request->sigscheck as $sigs)
			{
				$siarr = explode('###', $sigs);
				$sigapp = new CustomerSignatory;
				$sigapp->customer_id = $cust->id;
				$sigapp->names = $siarr[0];
				$sigapp->designation = $siarr[1];
				$sigapp->save();
			}
		}
		//Process Audits
		$audit=new Audit;
		$audit->user_id =Auth::user()->id;
		$audit->module="Customers";
		$audit->action="Update customer with customer_name ".$request->customer_name." Address " . $request->customer_address."  and customer ID " .$cust->id;
		$audit->save();
		return redirect('customers');
		//return "Request saved successful";
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
		$cust=Customer::find($id);
		$cust->delete();
		return "Request successful processed";
	}

}
