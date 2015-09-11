<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$details="";
$security_status="";
$others="";
$Landed_Property="";
$rate_applied="";
if( count($crp->proposedsecurity) !=0 )
{

    $id=$crp->proposedsecurity->id;
    $ps=$crp->proposedsecurity;
    $details=$ps->details;
    $security_status=$ps->status;
    $rate_applied=$ps->rate_applied;
    $apprequest=1;
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table  border="0" class="table table-bordered">
                <tr>
                    <th class="col-md-1" bgcolor="#EEEEEE">(C)</th>
                    <th class="col-md-3" bgcolor="#EEEEEE">EXISTING SECURITY</th>
                    <th class="col-md-2" bgcolor="#EEEEEE">CURRENCY</th>
                    <th class="col-md-2" bgcolor="#EEEEEE">OPEN MARKET VALUE</th>
                    <th class="col-md-2" bgcolor="#EEEEEE">FORCED SALE VALUE </th>
                    <th class="col-md-2" bgcolor="#EEEEEE">TO BE CHARGED FOR </th>
                </tr>
                @if($details !="" && count($details)> 0)
                    <?php
                    $open_marketvalueT=0;
                    $forced_salevalueT=0;
                    $tobe_chargesT=0;
                    $co=1;
                    ?>
                    @foreach($details as $d)
                        <?php
                            if( \App\Http\Controllers\CurrencyController::isNotBaseCurrency($d->ccy_1))
                            {

                                $open_marketvalueT +=($d->open_marketvalue * $rate_applied)/1000;
                                $forced_salevalueT +=($d->forced_salevalue * $rate_applied)/1000;
                                $tobe_chargesT +=($d->tobe_charges * $rate_applied)/1000;
                            }
                            else{
                                $open_marketvalueT +=$d->open_marketvalue;
                                $forced_salevalueT +=$d->forced_salevalue;
                                $tobe_chargesT +=$d->tobe_charges;

                            }
                            ?>
                            @if($d->security_type =="Landed Property")

                               <?php
                                   $Landed_Property .='<tr> <td align="center" valign="top">'.$co.'</td>
                                    <td valign="top">
                                        <p><strong><u>Immovable Property</u> </strong> <br/> '.$d->immovable.'</p>
                                        <p><strong>Location: </strong> '.$d->location.'</p>
                                        <p><strong>Area: </strong> '.$d->location.'</p>
                                        <p><strong>Certificate of Title: </strong> '.$d->location.'</p>
                                        <p><strong>Ownership: </strong> '.$d->owner.'</p>
                                        <p><strong>Tenor: </strong> '.$d->tennor.'</p>
                                        <p><strong>Built up Area: </strong> '.$d->plot_area.'</p>
                                        <p><strong>Valued by: </strong>'.$d->valued_by.'</p>
                                        <p><strong>Valued on: </strong> '.$d->valued_on.'</p>
                                        <p><strong>Valued at: </strong> '.$d->valued_at.'</p>
                                    </td>
                                    <td align="center" valign="middle">'.$d->ccy_1.'</td>
                                    <td align="center" valign="middle">'.$d->open_marketvalue.'</td>
                                    <td align="center" valign="middle">'.$d->forced_salevalue.'</td>
                                    <td align="center" valign="middle">'.$d->tobe_charges.'</td>
                                </tr>';
                             ?>


                            @else
                                <?php

                               $others .=' <tr> <td align="center" valign="top">'.$co.'</td>
                                    <td>'.$d->existing_security.'</td>
                                     <td>'.$d->ccy_1.'</td>
                                   <td>'.$d->open_marketvalue.'</td>
                                   <td>'.$d->forced_salevalue.'</td>
                                   <td>'.$d->tobe_charges.'</td>
                                   </tr>';
                                ?>

                            @endif
                            <?php $co++; ?>
                    @endforeach
                    <?php
                        echo $Landed_Property;
                        echo $others;
                    ?>

                    <tr>
                        <td valign="top" colspan="3"><strong>Total in TZS Equivalent (in mio)</strong></td>
                        <td align="center" valign="middle"><strong>{{number_format(($open_marketvalueT), 2, '.', ', ')}}</strong></td>
                        <td align="center" valign="middle"><strong>{{number_format(($forced_salevalueT), 2, '.', ', ')}}</strong></td>
                        <td align="center" valign="middle"></td>

                    </tr>

                @endif


            </table>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <p><strong>Rate Applied</strong> {{$rate_applied}}</p>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <p><strong>Security Status</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p><?php echo $security_status; ?></p>
        </div>
    </div>
    <div class="row" style="margin-left: 20px; margin-bottom: 30px">
        <div class="col-md-12">
            <div class="col-md-2 pull-right">
                <a href="#" data-dismiss="modal"  class="btn btn-success btn-block">   Ok </a>
            </div>
        </div>
    </div>
</div>



