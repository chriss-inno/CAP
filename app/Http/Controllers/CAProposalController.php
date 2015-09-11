<?php namespace App\Http\Controllers;

use App\CreditApp;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\AccountProfileRequest;

use App\CASerialNumber;
use App\CapSerial;
use Illuminate\Support\Facades\Auth;
use App\CurrentBankers;
use App\Providers\RouteServiceProvider;
use App\FormStage;
use App\Audit;
class CAProposalController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
        public function __construc()
        {
             if(Auth::guest())
             {
                return view('users.login');
             }
        }
    //Show form
    public function showForm()
    {

        //Testing form wizards
        //Gets start serial number
        $snos=0;

        if(count(CASerialNumber::all()) > 0)
        {
            $snos= CASerialNumber::all()->first()->startno;
        }


        $capSerial = new CapSerial;
        $capSerial->serialno=$snos;
        $capSerial->save();
        $id= $capSerial->id;
        $capSerial->serialno= ($snos + $id);
        $capSerial->save();
        $sno=$capSerial->serialno . "/" .date("Y");

        //$sno=rand(substr(strtotime(date("Y-m-d h:m:s")),3),3)."/".date("Y");
        return view('caproposal.add',compact('sno'));
    }
//process form one
    public function  storeForm1(AccountProfileRequest $request)
    {

        $CreditApp=new \App\CreditApp;

        $CreditApp->sno= $request->sno;
        $CreditApp->ap_date= $request->ap_date;
        $CreditApp->ac_name= $request->ac_name;
        $CreditApp->ac_address= $request->ac_address;
        $CreditApp->contact_person= $request->contact_person;
        $CreditApp->rm= $request->rm;
        $CreditApp->emanagement= $request->emanagement;

        $CreditApp->group= $request->ap_date;

        $CreditApp->business_activity= $request->business_activity;
        $CreditApp->legal_entity= $request->legal_entity;

        $CreditApp->credit_rating= $request->credit_rating;
        $CreditApp->borrowerid= $request->borrowerid;

        $CreditApp->open_type=$request->open_type;
        $CreditApp->app_type=$request->app_type;

        $CreditApp->g_indicator=$request->g_indicator;

        $CreditApp->group= $request->group;
        $CreditApp->current_stage =1;

        $CreditApp->save();

        $directors=$request->directors;
        $shareholders=$request->shareholders;
        $holdings=$request->holdings;
        $id= $CreditApp->id;

        //Form  stage
        $completed=25;


       //Insert directors
        foreach($directors as $director)
        {
            $cairectors=new \App\CADirectors;
            $cairectors->crp_id=$CreditApp->id;
            $cairectors->fullname=$director;
            $cairectors->save();

            $completed=50;
        }
       //Insert into share holders

        for($i=0; $i<sizeof($shareholders); $i++)
        {
            if($shareholders[$i] != "" && $shareholders[$i] !=null)
            {
                $cashareholders = new \App\CAShareholders;
                $cashareholders->crp_id = $CreditApp->id;
                $cashareholders->name = $shareholders[$i];
                $cashareholders->holding = $holdings[$i];
                $cashareholders->save();

                $completed=75;
            }
        }

        //Insert current bankers
       foreach($request->cr_bankers as $cb)
       {
           $currentBankers =new CurrentBankers;
           $currentBankers->crp_id=$id;
           $currentBankers->bankname=$cb;
           $currentBankers->save();
           $completed=100;
       }

       //Process form stages
        $formStage =new FormStage();
        $formStage->crp_id=$id;
        $formStage->stage_name="Account profile";
        $formStage->completed=$completed;
        $formStage->save();

        $stage_array=["Account profile","Account performance","Covenants","Facility Structure","Final recommendations","Proposed security","Pricing Rationale","Business Activity Review","Environment Review","Financial Analysis Review","Swot Analysis","Credit Risk Grading"];
       foreach($stage_array as $stg)
       {
           $formStage =new FormStage();
           $formStage->crp_id=$id;
           $formStage->stage_name=$stg;
           $formStage->save();
       }
      //Process Audits
        $audit=new Audit;
        $audit->user_id =Auth::user()->id;
        $audit->module=" Credit Proposal Account profile";
        $audit->action=" Creating new  Credit Proposal Account profile for " .$request->ac_name ." With serial number ".$request->sno;
        $audit->save();

        //return redirect('facility-structure')->with('id');
        return view('caproposal.facilitystructure',compact('id'));


    }

     //Show form summry
  public function showSummry($id)
  {
      $ca=CreditApp::find($id);


      echo '<table style="width: 100%" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      echo "<tr>";
      echo "<th style='width: 20%'>Form type</th>";
      echo "<th>Complete(%)</th>";
      echo "<th style='width: 20%'>Add/Update</th>";
      echo "<th style='width: 20%'>Remove/Clear</th>";
      echo "<th style='width: 20%'>View</th>";
      echo "<th style='width: 10%' align='center'>Get Report</th>";
      echo "</tr>";

      foreach($ca->formstage as $s)
      {
          if( $s->completed >= 80 &&  $s->completed <= 100 ){
              $class = "success";
          }elseif( $s->completed >= 60 &&  $s->completed <= 80){
              $class = "primary";
          }elseif( $s->completed >= 40 &&  $s->completed <= 60){
              $class = "info";
          } elseif( $s->completed >= 20 &&  $s->completed <= 40){
              $class = "warning";
          }else{
              $class = "danger";
          }
          $prog = '<div class="progress" id="pro'.$s->id.'">
                    <div title="'.$s->completed.'%" class="progress-bar progress-bar-striped active progress-bar-'.$class.'" role="progressbar" aria-valuenow="'.$s->completed.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$s->completed.'%">
                   '.$s->completed.'
                    </div>
                    </div>';
          echo "<tr>";
          echo "<td >". $s->stage_name."</td>";
          echo "<td>".$prog."</td>";

          if( \App\Http\Controllers\UserController::checkUpdateAccess(Auth::user()->id,1,1))
          {
              echo "<td id='".$s->id."'><a href='#' class='addform text-info' title='Add new or update form to the application '> <i class='icon-pencil'></i>Add/Update</a></td>";
          }
          else
          {

              echo "<td id='".$s->id."'> Not Allowed </td>";

          }
          if(  \App\Http\Controllers\UserController::checkDeleteAccess(Auth::user()->id,1,1))
          {

              echo "<td id='".$s->id."'><a href='#' class='delform text-danger' title='Remove form from application'> <i class='icon-remove text-danger'></i>Remove/Clear </a></td>";
          }
          else
          {

              echo "<td id='".$s->id."'> Not Allowed </td>";
          }

          echo "<td id='".$s->id."'><a href='#' class='summary text-success'> <i class='icon-list''></i> view Report </a></td>";
          echo "<td><a href='".url("download/pdf/".$s->id)."' class=' text-warning''> <i class='icon-download-alt'> </i> Download </a></td>";
          echo "</tr>";
      }
      echo "</table>";
?>
      <script>
          $(".summary").click(function(){
              var id1 = $(this).parent().attr('id');
              var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
              modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
              modal+= '<div class="modal-content">';
              modal+= '<div class="modal-header">';
              modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
              modal+= '<h4 class="modal-title" id="myModalLabel">Application Form preview</h4>';
              modal+= '</div>';
              modal+= '<div class="modal-body">';
              modal+= ' </div>';
              modal+= '</div>';
              modal+= '</div>';

              $("body").append(modal);
              $("#myModal").modal("show");
              $(".modal-body").html("<h3><i class='icon-spinner'></i><span>loading...</span><h3>");
              $(".modal-body").load("<?php echo url("formsummary") ?>/"+id1);
              $("#myModal").on('hidden.bs.modal',function(){
                  $("#myModal").remove();
              })

          })
          $(".addform").click(function(){
              var id1 = $(this).parent().attr('id');
              var modal = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
              modal+= '<div class="modal-dialog" style="width:70%;margin-right: 15% ;margin-left: 15%">';
              modal+= '<div class="modal-content">';
              modal+= '<div class="modal-header">';
              modal+= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
              modal+= '<h4 class="modal-title" id="myModalLabel">Application form add new/Update</h4>';
              modal+= '</div>';
              modal+= '<div class="modal-body">';
              modal+= ' </div>';
              modal+= '</div>';
              modal+= '</div>';

              $("body").append(modal);
              $("#myModal").modal("show");
              $(".modal-body").html("<h3><span><i class='icon-spinner'></i> loading...</span><h3>");
              $(".modal-body").load("<?php echo url("processform") ?>/"+id1);
              $("#myModal").on('hidden.bs.modal',function(){
                  $("#myModal").remove();
              })

          })

          $(".delform").click(function(){
              var id1 = $(this).parent().attr('id');
              var previ = $(this).parent().html();
              $(".delform").show("slow").parent().parent().find("span").remove();
              var btn = $(this).parent();
              var idsel="pro"+ id1;
              var pro= document.getElementById(idsel);
              $(this).hide("slow").parent().append("<span><br>Are You Sure <br /><br><a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
              $("#no").click(function(){
                  $(this).parent().parent().find(".delform").show("slow");
                  $(this).parent().parent().find("span").remove();
              });
              $("#yes").click(function(){
                  $(".delform").show("slow").parent().parent().find("span").remove();
                 // $(this).parent().html("<br><i class='icon-spinner icon-spin'></i> Removing...");
                  $.get("<?php echo url('removeform') ?>/"+id1,function(data){
                      $(".delform").show("slow").parent().parent().find("span").remove();
                      pro.innerHTML="<div title='0%' class='progress-bar progress-bar-striped active progress-bar' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%'>0 </div>";

                  });

              });
          });
          $(".publishall").click(function(){
              var id1 = $(this).attr('id');
              $(".publishall").show("slow").parent().find("span").remove();
              var btn = $(this).parent();
              $(this).hide("slow").parent().append("<span><br>Are You Sure <br /><br><a href='#s' id='yes' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Yes</a> <a href='#s' id='no' class='btn btn-danger btn-xs'> <i class='fa fa-times'></i> No</a></span>");
              $("#no").click(function(){
                  $(this).parent().parent().find(".publishall").show("slow");
                  $(this).parent().parent().find("span").remove();
              });
              $("#yes").click(function(){
                  $(this).parent().html("<br><i class='fa fa-spinner fa-spin'></i>publishing...");
                  $.post("<?php echo url('order/publishall') ?>/"+id1,function(data){
                      btn.html("<i class='fa fa-check'></i> Published");
                  });
              });
          });
      </script>
<?php

  }
    //showw test view
    public function  showAppforms()
    {
        return view('caproposal.listforms');
    }
	public function index()
	{
		//
        return view('caproposal.appform');
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
  //show manage

}
