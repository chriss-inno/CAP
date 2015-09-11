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
{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table  cellpadding="0" cellspacing="0" style=" border: 1px solid #ddd;" border="1" width="100%">
                <tr>

                    <th colspan="4" align="center" bgcolor="#EEEEEE" class="col-md-9" style="text-align: center">(F) ACCOUNT PERFORMANCE</th>
                </tr>
                @if( count($crp->accountperformance) !=0 )
                @if(count($apb) > 0 && $apb !=""  )
                    @foreach($apb as $bk)
                        <tr style="">
                            <td rowspan="2"  class="col-md-4">Names of the banks where the accounts are maintained.</td>
                            <td colspan="3" align="center" class="col-md-10">{{$bk->bank_maintained}}</td>
                        </tr>
                            @if(count($aptz) > 0 && $aptz !="")
                        <tr style="">
                            <td colspan="3" align="right" class="col-md-10"><strong>Figures in TZS &quot;mio&quot;</strong></td>
                        </tr>
                        <tr style="">
                            <th class="col-md-4">Month</th>
                            <th class="col-md-4">Low balance</th>
                            <th class="col-md-4">High balance</th>
                            <th class="col-md-4">Turnover</th>
                        </tr>
                        <?php $total=0; ?>
                        @foreach($aptz as $tz)
                            <?php $total +=$tz->tzs_turnover ; ?>
                            <tr style="">
                                <td class="col-md-4">{{$tz->tzs_month}}</td>
                                <td class="col-md-4">{{$tz->tzs_low_balance}}</td>
                                <td class="col-md-4">{{$tz->tzs_high_balance}}</td>
                                <td class="col-md-4">{{$tz->tzs_turnover}}</td>
                            </tr>
                        @endforeach
                        <tr style="">
                            <td colspan="3" align="left" class="col-md-4"><strong>Total</strong></td>
                            <td class="col-md-4">{{number_format($total, 2, '.', ', ')}}</td>
                        </tr>
                        <tr style="">
                            <td colspan="3" align="left" class="col-md-4"><strong>Less term loan disbursement Internal fund transfers</strong></td>
                            <td class="col-md-4">{{$bk->loan_disbursement_tzs}}</td>
                        </tr>
                        <tr style="">
                            <td colspan="3" align="left" class="col-md-4"><strong>Actual credit turnover</strong></td>
                            <td class="col-md-4">{{$bk->Credit_turnover_tzs}}</td>
                        </tr>
                            @endif
                            @if(count($apusd) > 0 && $apusd !="")
                        <tr style="">
                            <td colspan="4" align="right" class="col-md-4"><strong>Figures in USD &quot;000&quot;</strong></td>
                        </tr>
                        <tr style="">
                            <th class="col-md-4">Month</th>
                            <th class="col-md-4">Low balance</th>
                            <th class="col-md-4">High balance</th>
                            <th class="col-md-4">Turnover</th>
                        </tr>
                        <?php $total_usdT=0; ?>
                        @foreach($apusd as $us)
                            <?php $total_usdT +=$us->usd_turnover ; ?>
                            <tr style="">
                                <td class="col-md-4">{{$us->usd_month}}</td>
                                <td class="col-md-4">{{$us->usd_low_balance}}</td>
                                <td class="col-md-4">{{$us->usd_high_balance}}</td>
                                <td class="col-md-4">{{$us->usd_turnover}}</td>
                            </tr>
                        @endforeach
                        <tr style="">
                            <td colspan="3" align="left" class="col-md-4"><strong>Total</strong></td>
                            <td class="col-md-4">{{number_format($total_usdT, 2, '.', ', ')}}</td>
                        </tr>
                        <tr style="">
                            <td colspan="3" align="left" class="col-md-4"><strong>Less term loan disbursement Internal fund transfers</strong></td>
                            <td class="col-md-4">{{$bk->loan_disbursement_usd}}</td>
                        </tr>
                        <tr style="">
                            <td colspan="3" align="left" class="col-md-4"><strong>Actual credit turnover</strong></td>
                            <td class="col-md-4">{{$bk->Credit_turnover_usd}}</td>
                        </tr>
                            @endif
                    @endforeach
                @endif
                <tr style="">
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
    <?php
    $crSignatories="";
    //Get signatories
    if(count($crp->customer->Signatories) > 0)
    {
        $crSignatories=$crp->customer->Signatories;
    }
    ?>
    <div class="row" style="margin-top: 10px">
        <div class="col-md-12">
            <table class="table table-bordered" >
                <tr>
                    <td>
                    <div class="col-md-12">
                        @if($crSignatories !=""  && count($crSignatories)>0 )
                            @foreach($crSignatories as $sig)
                                <p>{{$sig->names}}-{{$sig->designation}} </p>
                            @endforeach
                        @endif
                   </div>
                     </td>
                </tr>
            </table>
        </div>
    </div>
</div>


