<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Signator;
use App\Http\Requests\SignatoryRequest;
class SignatoriesContoller extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		//
       $signators =Signator::all();
        return view('Signatories.list',compact('signators'));
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
	public function store($sig)
	{
		//
        $Signator =new Signator;
        $Signator->names=$sig;
        $Signator->save();

        ?>
<table class="table table-striped table-bordered table-hover table-checkable table-responsive">
    <thead>
    <tr>

        <th data-class="expand">Signatory Name</th>
        <th class="checkbox-column">
            <input type="checkbox" class="uniform">
        </th>
    </tr>
    </thead>
    <tbody>
    <?php

    $signators =Signator::all();
    foreach($signators as $sg)
    {

   echo ' <tr>';

       echo ' <td>'.$sg->names.'</td>';
       echo '  <td class="checkbox-column">';
       echo     ' <input type="checkbox" value="'.$sg->id.'" class="uniform" name="signat[]">';
       echo ' </td>

    </tr>';


    } ?>

    </tbody>
</table>

<?php
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
