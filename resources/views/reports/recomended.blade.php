<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$details="";
$security_status="";
if( count($crp->proposedsecurity) !=0 )
{

    $id=$crp->proposedsecurity->id;
    $ps=$crp->proposedsecurity;
    $details=$ps->details;
    $security_status=$ps->status;
    $apprequest=1;
}
?>

{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <th class="col-md-1" bgcolor="#EEEEEE">(C)</th>
                    <th class="col-md-5" bgcolor="#EEEEEE">Proposed security</th>
                    <th class="col-md-2" bgcolor="#EEEEEE">Open market value</th>
                    <th class="col-md-2" bgcolor="#EEEEEE">Forced sale Value </th>
                    <th class="col-md-2" bgcolor="#EEEEEE">To be charged for </th>
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
                        $open_marketvalueT +=$d->open_marketvalue;
                        $forced_salevalueT +=$d->forced_salevalue;
                        $tobe_chargesT +=$d->tobe_charges;
                        ?>
                        <tr>
                            <td align="center" valign="top">{{$co}}</td>
                            <td valign="top">
                                <p><strong><u>Immovable Property</u></strong> <br/> First legal mortgage over Land & Building</p>
                                <p><strong>Location: </strong> {{$d->location}}</p>
                                <p><strong>Area: </strong> {{$d->location}}</p>
                                <p><strong>Certificate of Title: </strong> {{$d->location}}</p>
                                <p><strong>Ownership: </strong> {{$d->owner}}</p>
                                <p><strong>Tenor: </strong> {{$d->tennor}}</p>
                                <p><strong>Plot size: </strong> {{$d->plot_area}}</p>
                                <p><strong>Valued by: </strong>{{$d->valued_by}}</p>
                                <p><strong>Valued on: </strong> {{$d->valued_on}}</p>
                                <p><strong>Valued at: </strong> {{$d->valued_at}}</p>
                            </td>
                            <td align="center" valign="middle">{{$d->open_marketvalue}}</td>
                            <td align="center" valign="middle">{{$d->forced_salevalue}}</td>
                            <td align="center" valign="middle">{{$d->tobe_charges}}</td>
                        </tr>
                        <?php $co++; ?>
                    @endforeach
                    <tr>
                        <td align="center" valign="top">&nbsp;</td>
                        <td align="right" valign="top"><strong>Total</strong></td>
                        <td align="center" valign="middle"><strong>{{$open_marketvalueT}}</strong></td>
                        <td align="center" valign="middle"><strong>{{$forced_salevalueT}}</strong></td>
                        <td align="center" valign="middle"></td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <p><strong>Security Status</strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p>{{$security_status}}</p>
        </div>
    </div>
</div>



