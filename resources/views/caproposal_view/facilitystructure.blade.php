<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$open_type="";
$app_type="";
$valid_date="";
$Limits=array();
$purpose="";
$remarks="";
$rate_applied=1;
$g_indicator="";
$fsg="";
$msg="";
//Get initial
$open_type=$crp->open_type;
$app_type=$crp->app_type;
if( count($crp->facilitystructure) !=0 )
{
    $apprequest=1;

    $valid_date=$crp->facilitystructure->valid_date;

    $purpose=$crp->facilitystructure->purpose;
    $valid_date=$crp->facilitystructure->valid_date;
    $remarks=$crp->facilitystructure->remarks;
    $rate_applied=$crp->facilitystructure->rate_applied;
    $fsg=$crp->facilitystructure->facilitygroups;
    $Limits =$crp->facilitystructure->facilitylimits;
    $id=$crp->facilitystructure->id;
    $g_indicator=$crp->accountprofile->g_indicator;
    $msg=$crp->facilitystructure->msg;

}
?>
<!-- Bootstrap -->
{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table  border="0" class="table table-bordered">
                <tr>
                    <td colspan="7" align="center"  bgcolor="#EEEEEE" class="col-md-12" ><strong>B: Facility Structure </strong> </td>
                </tr>
                <tr>
                    <td colspan="7" align="center" class="col-md-12" ><span><strong>TYPE OF APPLICATION</strong></span></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"  class="col-md-5" ><strong>New</strong></td>
                    <td align="center"  class="col-md-1" >@if($open_type =="New")&#10004; @endif</td>
                    <td colspan="2" align="center"  class="col-md-5" ><strong>Existing level</strong></td>
                    <td align="center"  class="col-md-1" >@if($app_type =="Existing level") &#10004; @endif</td>
                </tr>
                <tr>
                    <td colspan="3" align="center"  class="col-md-5" ><strong>Renewal</strong></td>
                    <td align="center"  class="col-md-1" >@if($open_type =="Renewal") &#10004; @endif</td>
                    <td colspan="2" align="center"  class="col-md-5" ><strong>Enhancement</strong></td>
                    <td align="center"  class="col-md-1" >@if($app_type =="Enhancement") &#10004; @endif</td>
                </tr>
                <tr>
                    <td colspan="3" align="center"  class="col-md-5" ><strong>Interim</strong></td>
                    <td align="center"  class="col-md-1" >@if($open_type =="Interim") &#10004; @endif</td>
                    <td colspan="2" align="center"  class="col-md-5" ><strong>Amendment</strong></td>
                    <td align="center"  class="col-md-1" >@if($app_type =="Amendment") &#10004; @endif </td>
                </tr>
                <tr>
                    <td colspan="7" align="right" class="col-md-12" ><h3>Limit in ACY | Outstanding in LCY <br/> <small>USD in "000" and TZS in "mio" </small></h3> </td>
                </tr>
                <tr>
                    <th class="col-md-2" ><span class="col-md-3">Facility</span></th>
                    <th class="col-md-1" ><span class="col-md-1">CCY</span></th>
                    <th class="col-md-2" >Current limits</th>
                    <th class="col-md-1" ><span class="col-md-1">CCY</span></th>
                    <th class="col-md-2" >Out Standing </th>
                    <th class="col-md-2" ><span class="col-md-1">Proposed </span></th>
                    <th class="col-md-2" >Tenor / expiry</th>
                </tr>
                @if($Limits != null && count($Limits) >0 )
                    <?php //Initialize total
                    $limitsT=0;
                    $proposedT=0;
                    $presentosT=0;

                    ?>

                        <?php
                        foreach($Limits as $l)
                            {
                           if( \App\Http\Controllers\CurrencyController::isNotBaseCurrency($l->ccy_1))
                               {
                                   $limitsT += ($l->cr_limits * $rate_applied)/1000;
                               }
                                else{
                                    $limitsT += $l->cr_limits;
                                }
                            if( \App\Http\Controllers\CurrencyController::isNotBaseCurrency($l->ccy_2))
                            {
                                $proposedT += ($l->proposed * $rate_applied)/1000;
                                $presentosT += ($l->presentos * $rate_applied)/1000;
                            }
                            else{
                                $proposedT += $l->proposed;
                                $presentosT += $l->presentos;
                                }


                        ?>
                        <tr>
                            <td >{{$l->facility}}</td>
                            <td >{{$l->ccy_1}}</td>
                            <td >{{$l->cr_limits}}</td>
                            <td >{{$l->ccy_1}}</td>
                            <td >{{$l->presentos}}</td>
                            <td >{{$l->proposed}}</td>
                            <td >{{$l->expire}}</td>
                        </tr>
                   <?php }?>


                        <tr>
                            <td align="right" colspan="2" ><strong>TOTAL IN TZS EQUIV</strong></td>
                            <td ><strong>{{number_format(($limitsT), 2, '.', ', ')}}</strong></td>
                            <td >&nbsp;</td>
                            <td ><strong>{{number_format(($presentosT), 2, '.', ', ')}}</strong></td>
                            <td ><strong>{{number_format(($proposedT), 2, '.', ', ')}}</strong></td>
                            <td >&nbsp;</td>
                        </tr>
                @endif
                @if($g_indicator != "" && $g_indicator =="Yes")
                @if($fsg != null && count($fsg) >0)
                    <tr>
                        <td colspan="7" align="right" class="col-md-12" ><h3>Group exposure  figures in TZS<br/> <small>"mio" and USD"000" </small></h3> </td>
                    </tr>
                    <tr>
                        <th align="right"class="col-md-2" >Client</th>
                        <th class="col-md-2">Facility</th>
                        <th class="col-md-1" >CCY</th>
                        <th class="col-md-2">Existing limit</th>
                        <th class="col-md-2">O/s bal as of</th>
                        <th class="col-md-2">Proposed limit</th>
                        <th class="col-md-1">GEL</th>
                    </tr>

                    <?php
                    $elimitT=0;
                    $osbalanceT=0;
                    $proposed_limitT=0;
                    $gelT=0;
                    ?>


                        <?php

                        foreach($fsg as $g)
                          {

                            if( \App\Http\Controllers\CurrencyController::isNotBaseCurrency($g->ccy))
                            {
                                $elimitT +=($g->existing_limit * $rate_applied)/1000;
                                $osbalanceT +=($g->osbalance * $rate_applied)/1000;
                                $proposed_limitT +=($g->proposed_limit * $rate_applied)/1000;
                                $gelT +=($g->gel* $rate_applied)/1000;
                            }
                            else{
                                $elimitT +=$g->existing_limit ;
                                $osbalanceT +=$g->osbalance ;
                                $proposed_limitT +=$g->proposed_limit ;
                                $gelT +=$g->gel;
                            }
                        ?>
                        <tr>
                            <td align="left" >{{$g->client}}</td>
                            <td >{{$g->facility}}</td>
                            <td >{{$g->ccy}}</td>
                            <td >{{$g->existing_limit}}</td>
                            <td >{{$g->osbalance}}</td>
                            <td >{{$g->proposed_limit}}</td>
                            <td >{{$g->gel}}</td>
                        </tr>
                 <?php }?>

                    <tr>
                        <td align="right" colspan="3" ><strong>TOTAL IN TZS EQUIV</strong></td>
                        <td ><strong>{{number_format(($elimitT), 2, '.', ', ')}}</strong></td>
                        <td ><strong>{{number_format(($osbalanceT), 2, '.', ', ')}}</strong></td>
                        <td ><strong>{{number_format(($proposed_limitT), 2, '.', ', ')}}</strong></td>
                        <td ><strong>{{number_format(($gelT), 2, '.', ', ')}}</strong></td>
                    </tr>
                @endif
                @endif
            </table>
        </div>
    </div>
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-3" ><strong>Rate Applied </strong> < <span style="border-bottom: 1px solid #000">{{$rate_applied}}</span> ></div>
    </div>
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12"><strong><?php echo $remarks;?></strong></div>
    </div>
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12"><?php echo $msg;?> </div>
    </div>
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12">
            <table width="100%" border="0" class="table table-bordered">
                <tr>
                    <td class="col-md-3 "><strong>Purpose</strong></td>
                    <td class="col-md-9 "><?php echo $purpose;?> </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style=" margin-top: 30px">
        <div class="col-md-12">
            <div class="col-md-2 pull-right">
                <a href="#" data-dismiss="modal"  class="btn btn-success btn-block">  Ok</a>
            </div>

        </div>
    </div>
</div>