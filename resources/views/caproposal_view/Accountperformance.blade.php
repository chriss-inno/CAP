<?php
$sno = $crp->sno;
$app_date=$crp->app_date;
$open_type=$crp->open_type;
$app_type=$crp->app_type;
$ac_name=$crp->ac_name;
$acaddress=$crp->ac_address;

$crid=$crp->id;
$apprequest =0;
$id=0;
$apb="";
$comments="";
$aptz="";
$apusd="";

    if( count($crp->accountperformance) !=0 )
    {
        $apprequest=1;
        $apb=$crp->accountperformance->accountperformanceBank;
        $aptz=$crp->accountperformance->accountperformanceTZS;
        $apusd=$crp->accountperformance->accountperformanceUSD;
        $id=$crp->accountperformance->id;
        $comments=$crp->accountperformance->comments;

    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" style="font-size: smaller;">
                <tr>
                    <th   bgcolor="#EEEEEE" class="col-md-3">(F)</th>
                    <th colspan="3" align="center" bgcolor="#EEEEEE" class="col-md-9">Account performance</th>
                </tr>
                @if( count($crp->accountperformance) !=0 )
                @if(count($apb) > 0 && $apb !=""  )
                    @foreach($apb as $bk)
                        <tr>
                            <td rowspan="2"  class="col-md-4">Names of the banks where the accounts are maintained.</td>
                            <td colspan="3" align="center" class="col-md-10">{{$bk->bank_maintained}}</td>
                        </tr>
                    @if(count($aptz) > 0 && $aptz !="")
                        <tr>
                            <td colspan="3" align="right" class="col-md-10"><strong>Figures in TZS &quot;mio&quot;</strong></td>
                        </tr>
                        <tr>
                            <th class="col-md-4">Month</th>
                            <th class="col-md-4">Low balance</th>
                            <th class="col-md-4">High balance</th>
                            <th class="col-md-4">Turnover</th>
                        </tr>
                        <?php $total=0; ?>
                        @foreach($aptz as $tz)
                            <?php $total +=$tz->tzs_turnover ; ?>
                            <tr>
                                <td class="col-md-4">{{$tz->tzs_month}}</td>
                                <td class="col-md-4">{{$tz->tzs_low_balance}}</td>
                                <td class="col-md-4">{{$tz->tzs_high_balance}}</td>
                                <td class="col-md-4">{{$tz->tzs_turnover}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" align="left" class="col-md-4"><strong>Total</strong></td>
                            <td class="col-md-4">{{$total}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" align="left" class="col-md-4"><strong>Less term loan disbursement Internal fund transfers</strong></td>
                            <td class="col-md-4">{{$bk->loan_disbursement_tzs}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" align="left" class="col-md-4"><strong>Actual credit turnover</strong></td>
                            <td class="col-md-4">{{$bk->Credit_turnover_tzs}}</td>
                        </tr>
                        @endif
                        @if(count($apusd) > 0 && $apusd !="")
                        <tr>
                            <td colspan="4" align="right" class="col-md-4"><strong>Figures in USD &quot;000&quot;</strong></td>
                        </tr>
                        <tr>
                            <th class="col-md-4">Month</th>
                            <th class="col-md-4">Low balance</th>
                            <th class="col-md-4">High balance</th>
                            <th class="col-md-4">Turnover</th>
                        </tr>
                        <?php $total_usdT=0; ?>
                        @foreach($apusd as $us)
                            <?php $total_usdT +=$us->usd_turnover ; ?>
                            <tr>
                                <td class="col-md-4">{{$us->usd_month}}</td>
                                <td class="col-md-4">{{$us->usd_low_balance}}</td>
                                <td class="col-md-4">{{$us->usd_high_balance}}</td>
                                <td class="col-md-4">{{$us->usd_turnover}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" align="left" class="col-md-4"><strong>Total</strong></td>
                            <td class="col-md-4">{{$total_usdT}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" align="left" class="col-md-4"><strong>Less term loan disbursement Internal fund transfers</strong></td>
                            <td class="col-md-4">{{$bk->loan_disbursement_usd}}</td>
                        </tr>
                        <tr>
                            <td colspan="3" align="left" class="col-md-4"><strong>Actual credit turnover</strong></td>
                            <td class="col-md-4">{{$bk->Credit_turnover_usd}}</td>
                        </tr>
                        @endif
                    @endforeach
                @endif
                <tr>
                    <td class="col-md-4"> <ol>
                            <li>Do the summations indicate adequate banking in comparison to  the volume of sales</li>
                            <li>If too low, the reasons there for.</li>
                        </ol></td>
                    <td colspan="3" class="col-md-8">{{$comments}}</td>
                </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2 pull-right">
                <a href="#" data-dismiss="modal"  class="btn btn-success btn-block">   Ok </a>
            </div>
        </div>
    </div>
</div>

