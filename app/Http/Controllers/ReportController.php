<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportGenerateRequest;
use Illuminate\Http\Request;
use App\CreditApp;
class ReportController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        return view('sysreports.index');
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

    //Generate
    public function generate(ReportGenerateRequest $request)
    {
        $apptype = $request->apptype;
        $search_text = $request->search_text;
        $date_from = date("Y-m-d", strtotime($request->date_from));
        $date_to = date("Y-m-d", strtotime($request->date_to));
        $range = [$date_from, $date_to];

        $table = "<span class='text-danger' style='text-align: center'><h2>No data found related to your search</h2></span>";

        $search = '%' . $search_text . '%';


        if ($apptype =="All") {
            $itemsarr=array('New','Renewal','Interim','Existing level','Enhancement','Amendment');
            $ca = CreditApp::where('ac_name', 'LIKE', $search)
                ->orWhere('ac_address', 'LIKE', $search)
                ->orWhere('contact_person', 'LIKE', $search)
                ->orWhere('rm', 'LIKE', $search)
                ->orwhereIn('open_type', $itemsarr)
                ->orWhereIn('app_type', $itemsarr)
                ->orwhereBetween('app_date', $range)->get();
        }
        elseif ($apptype !="" && $date_from !="" &&$date_to !=""  &&$search_text !="") {

            $ca = CreditApp::where('ac_name', 'LIKE', $search)
                ->orWhere('ac_address', 'LIKE', $search)
                ->orWhere('contact_person', 'LIKE', $search)
                ->orWhere('rm', 'LIKE', $search)
                ->orWhere('open_type', 'LIKE', $apptype)
                ->orWhere('app_type', 'LIKE', $apptype)
                ->orwhereBetween('app_date', $range)->get();
        }elseif ($apptype !="" ) {

        $ca = CreditApp::Where('open_type', 'LIKE', $apptype)
            ->orWhere('app_type', 'LIKE', $apptype)->get();

        }elseif ( $date_from ="" &&$date_to !="" ) {

            $ca = CreditApp::whereBetween('app_date', $range)->get();
        }elseif ($search_text !="") {

            $ca = CreditApp::where('ac_name', 'LIKE', $search)->get();
        }



        if(count($ca) > 0) {
            $table ='<div class="row">
                <!-- Bootstrap <div class="col-md-1 pull-right"><button class="btn btn-block"><img src="images/Excel-icon.png" style="float: left; margin-right: 2px"/></button> </div>-->
              <div class="col-md-1 pull-right"><button class="btn btn-block"> <img src="images/pdf-icon.png" style="float: left; margin-right: 2px"/></button></div>
                 <div class="col-md-1 pull-right"><strong>Export Data</strong></div>
                 <input type="hidden" name="apptype" value="'.$request->apptype.'">
                 <input type="hidden" name="date_from" value="'.$request->date_from.'">
                 <input type="hidden" name="date_to" value="'.$request->date_to.'">
                 <input type="hidden" name="search_text" value="'.$request->search_text.'">
                <div class="col-md-6 pull-right" id="exportdisplay"> </div>
                </div>';

            $table .= '<table class="table table-striped table-bordered table-hover table-checkable table-responsive datatable dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                            <thead>
                                      <tr>
                                        <th>SNO</th>
                                        <th>Serial Number</th>
                                        <th data-hide="expand">Application Date</th>
                                        <th data-class="expand">Account Name</th>
                                        <th data-hide="expand">Address</th>
                                        <th data-hide="expand">Management contact person</th>
                                        <th data-hide="expand">Relationship manager</th>
                                        <th>Standard Report </th>
                                        <th>Custom  Report </th>
                                        <th>Application Type</th>
                                        <th>View forms</th>
                                     </tr>
                            </thead>
                            <tbody role="alert" aria-live="polite" aria-relevant="all"><tr class="odd">';
            $cou = 1;
            foreach ($ca as $c) {
                $table .= '<tr>';
                $table .= '<td>' . $cou . '</td>';
                $table .= '<td>' . $c->sno . '</td>';
                $table .= '<td>' . $c->app_date . '</td>';
                $table .= '<td>' . $c->ac_name . '</td>';
                $table .= '<td>' . $c->ac_address . '</td>';
                $table .= '<td>' . $c->contact_person . '</td>';
                $table .= '<td>' . $c->rm . '</td>';
                $table .= '<td><a href="' . url("download/pdf/st-report/" . $c->id) . '" title="Download Report"  class="text-success"> <i class="icon-download-alt"> </i> </a></td>';
                $table .= ' <td><a href="' . url("download/pdf/report/" . $c->id) . '" title="Download Report"  class="text-success"> <i class="icon-download-alt"> </i> </a></td>';
                $table .= '<td>' . $c->open_type . '</td>';
                $table .= '<td style="text-align: center"><a href="' . url("credit-proposal/" . $c->id) . '" title="View Application forms"  class="text-warning"> <img src="images/open.png"/> </a></td>';
                          $table.='</tr>';
                $cou ++;
                      }
             $table .=' </tbody></table>';

        }
        $table.="<script>
        $('.expExcel').click( function() {


                            $('#exportdisplay').html('<h3><span class=\"text-info\"><i class=\"icon-spinner icon-spin\"></i>Data exports please wait...</span><h3>');
                            var postData = $('#ajax-search-form').serializeArray();
                            var formURL = $('#ajax-search-form').attr('action');
                            $.ajax(
                                    {
                                        url : formURL,
                                        type: 'POST',
                                        data : postData,
                                        success:function(data)
                                        {
                                           // console.log(data);
                                            //data: return data from server
                                           // $('#exportdisplay').html(data);
                                            setTimeout(function() {
                                                $('#exportdisplay').html('');
                                            }, 3000);
                                        },
                                        error: function(data)
                                        {
                                            console.log(data.responseJSON);
                                            //in the responseJSON you get the form validation back.
                                            $('#exportdisplay').html('<h3><span class=\"text-info\"><i class=\"icon-spinner icon-spin\"></i> Error in processing data try again...</span><h3>');
                                            $('#exportdisplay').html(data);
                                            setTimeout(function() {
                                                $('#output').html('');
                                            }, 3000);
                                        }
                                    });
        });
        </script>";

      return $table;
    }

    public function excelExport(ReportGenerateRequest $request)
    {
        $apptype = $request->apptype;
        $search_text = $request->search_text;
        $date_from = date("Y-m-d",strtotime($request->date_from));
        $date_to =  date("Y-m-d",strtotime($request->date_to));
        $range = [$date_from, $date_to];

        $table="<span class='text-danger' style='text-align: center'><h2>No data found related to your search</h2></span>";

        $search = '%' . $search_text . '%';
        $ca = CreditApp::where('ac_name', 'LIKE', $search)
            ->orWhere('ac_address', 'LIKE', $search)
            ->orWhere('contact_person', 'LIKE', $search)
            ->orWhere('rm', 'LIKE', $search)
            ->orWhere('open_type', 'LIKE', $apptype)
            ->orWhere('app_type', 'LIKE', $apptype)
            ->orwhereBetween('app_date', $range)->get();

        if ($apptype =="All") {
            $itemsarr=array('New','Renewal','Interim','Existing level','Enhancement','Amendment');
            $ca = CreditApp::where('ac_name', 'LIKE', $search)
                ->orWhere('ac_address', 'LIKE', $search)
                ->orWhere('contact_person', 'LIKE', $search)
                ->orWhere('rm', 'LIKE', $search)
                ->orwhereIn('open_type', $itemsarr)
                ->orWhereIn('app_type', $itemsarr)
                ->orwhereBetween('app_date', $range)->get();
        }

        elseif ($apptype !="" && $date_from !="" &&$date_to !=""  &&$search_text !="") {

            $ca = CreditApp::where('ac_name', 'LIKE', $search)
                ->orWhere('ac_address', 'LIKE', $search)
                ->orWhere('contact_person', 'LIKE', $search)
                ->orWhere('rm', 'LIKE', $search)
                ->orWhere('open_type', 'LIKE', $apptype)
                ->orWhere('app_type', 'LIKE', $apptype)
                ->orwhereBetween('app_date', $range)->get();
        }elseif ($apptype !="" ) {

            $ca = CreditApp::Where('open_type', 'LIKE', $apptype)
                ->orWhere('app_type', 'LIKE', $apptype)->get();

        }elseif ( $date_from ="" &&$date_to !="" ) {

            $ca = CreditApp::whereBetween('app_date', $range)->get();
        }elseif ($search_text !="") {

            $ca = CreditApp::where('ac_name', 'LIKE', $search)->get();
        }


        $fo="Credit Application Reports, generated on system at  ".date("Y-m-d h:m:s");
        $pdf = \PDF::loadView('sysreports.expExcel',compact('ca'))
            ->setOption('footer-font-size', 7 )
            ->setOption('title', $fo )
            ->setOption('footer-left', $fo )
            ->setOption('footer-right', 'Page [page]' )
            ->setOption('page-offset', 0 );

        return $pdf->download('caproposal_pdf_report.pdf');
    }

}
