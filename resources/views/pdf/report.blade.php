@extends('layout.master')
@section('title')
    CA  Lists | Credit Application System
@stop
@section('breadcrumbs')

    <li>
        <i class="icon-home"></i>
        <a href="{{url('profile')}}">CA lists</a>
    </li>
    <li>
        <i class="icon-home"></i>
        Manage CA Proposals
    </li>

@stop
@section('pagescripts')
    <!--dynamic table initialization -->
    <!-- DataTables -->
    {!!HTML::script("plugins/datatables/jquery.dataTables.min.js") !!}
    {!!HTML::script("plugins/datatables/DT_bootstrap.js") !!}
    {!!HTML::script("plugins/datatables/responsive/datatables.responsive.js") !!} <!-- optional -->
@stop
@section('contents')
    {!! Form::open(array('url' =>url('download/pdf/report'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
    <div class="row row-bg">
        <!--=== Responsive DataTable ===-->
        <div class="row" style="margin-left: 20px; margin-bottom: 30px">
            <div class="col-md-12">
                <div class="col-md-2 pull-right">
                    <a href="{{url('cap-manage')}}" class="btn btn-info btn-block"> <i class="icol-cog"></i> Manage </a>
                </div>
                <div class="col-md-2 pull-right">
                    <a href="{{url('credit-proposal')}}" class="btn btn-primary btn-block"><i class="icon-folder-open-alt"></i> New Application</a>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 10px">
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> Credit Application  <code>Report</code></h4>
                        <div class="toolbar no-padding">
                            <div class="btn-group">
                                <span class="btn btn-xs widget-collapse"><i class="icon-angle-down"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content no-padding" id="appcontentslist">
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="example2" >
                            <thead>
                            <tr>
                                <th class="checkbox-column">
                                    ID
                                </th>
                                <th>Serial Number</th>
                                <th data-hide="expand">Application Date</th>
                                <th data-class="expand">Account Name</th>
                                <th data-hide="expand">Address</th>
                                <th data-hide="expand">Management contact person</th>
                                <th data-hide="expand">Relationship manager</th>

                            </tr>
                            </thead>
                            <tbody>


                            <tr>
                                <td class="checkbox-column">
                                    {{$cap->id}}
                                </td>
                                <td>{{$cap->sno}}</td>
                                <td>{{$cap->app_date}}</td>
                                <td>{{$cap->ac_name}}</td>
                                <td><?php echo $cap->ac_address; ?></td>
                                <td>{{$cap->contact_person}}</td>
                                <td>{{$cap->rm}}</td>

                            </tr>
                            <tr><td colspan="8"><h3 class="text-primary">Select form for report generation   </h3></td></tr>
                            <tr>
                                <td colspan="8" style="background-color: #eee;">
                                    <?php
                                    echo '<table style="width: 100%" cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                                    echo "<tr>";
                                    echo "<th style='width: 20%'>Form Type</th>";
                                    echo "<th>Complete(%)</th>";
                                    echo "<th style='width: 10%' align='center'>Inlude in report?</th>";
                                    echo "</tr>";

                                    echo "<tr>";
                                    echo "<td style='width: 20%'>Account Profile</td>";
                                    echo '<td> <div class="progress">
                                            <div title="100%" class="progress-bar progress-bar-striped active progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                           100
                                            </div>
                                            </div></td>';
                                    echo "<td><input type='checkbox' name='reportforms[]' value='Account profile' class='form-control' / ></td>";
                                    echo "</tr>";
                                    foreach($cap->formstage as $s)
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
                                        $prog = '<div class="progress">
                    <div title="'.$s->completed.'%" class="progress-bar progress-bar-striped active progress-bar-'.$class.'" role="progressbar" aria-valuenow="'.$s->completed.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$s->completed.'%">
                   '.$s->completed.'
                    </div>
                    </div>';
                                        if($s->stage_name !="Pricing Rationale")
                                        {
                                        echo "<tr>";
                                        echo "<td >". $s->stage_name."</td>";
                                        echo "<td>".$prog."</td>";

                                        $varDis="";

                                        switch( $s->stage_name)
                                        {
                                            case "Account performance":
                                                    $crp =\App\CreditApp::find($s->crp_id);
                                                    if( $crp->accountperformance==null || count($crp->accountperformance) ==0)
                                                    {
                                                        $varDis ="disabled='disabled'";
                                                    }
                                                 break;
                                            case "Covenants":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->covenants==null || count($crp->covenants) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Facility Structure":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->facilitystructure==null || count($crp->facilitystructure) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Final recommendations":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if(  count($crp->facilitystructure) ==0)
                                                {
                                                   if(count($crp->facilitystructure) ==0)
                                                       {
                                                           $varDis ="disabled='disabled'";
                                                       }

                                                }
                                                break;
                                            case "Proposed security":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->proposedsecurity==null || count($crp->proposedsecurity) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                           /*
                                            * This section was removed as the pricing rationale form will be available to covenant
                                            case "Pricing Rationale":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->pricingrationale==null || count($crp->pricingrationale) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                           */
                                            case "Business Activity Review":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->businessactivity==null || count($crp->businessactivity) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Environment Review":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->environment==null || count($crp->environment) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Financial Analysis Review":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->financialAnalysis==null || count($crp->financialAnalysis) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Swot Analysis":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->swotanalysis==null || count($crp->swotanalysis) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Credit Risk Grading":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->creditRiskGrading==null || count($crp->creditRiskGrading) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Annexure-I":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->annexure_i==null || count($crp->annexure_i) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Annexure-II":
                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->annexure_ii==null || count($crp->annexure_ii) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;
                                            case "Account profile":

                                                $crp =\App\CreditApp::find($s->crp_id);
                                                if( $crp->accountprofile==null || count($crp->accountprofile) ==0)
                                                {
                                                    $varDis ="disabled='disabled'";
                                                }
                                                break;

                                        }


                                              echo "<td><input type='checkbox' name='reportforms[]' value='$s->stage_name'".$varDis." class='form-control' / ></td>";


                                        echo "</tr>";
                                            }
                                    }
                                    echo "</table>";
                                    ?>
                                </td>
                            </tr>
                            <tr><td colspan="8"> <div class="col-md-4 col-md-offset-4"> <input type="hidden" name="cid" value="{{$cap->id}}" /> <span id="butnreport"> <input type="submit" class="btn  btn-primary  btn-block"  value="Generate Report"/></span> </div> </td></tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
@stop