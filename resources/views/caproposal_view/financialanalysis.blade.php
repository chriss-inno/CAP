<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$fin="";
$sale="";
$profitability="";
$gearing="";
$dscr="";
$creditors ="";
$debtor="";
$liquidity="";
$worth="";



if( count($crp->financialAnalysis) !=0 )
{
    $fna=$crp->financialAnalysis;

    $id=$fna->id;
    $apprequest=1;

    //Financial analysis components
    $sale=$fna->sale;
    $profitability=$fna->profitability;
    $gearing=$fna->gearing;
    $dscr=$fna->dscr;
    $creditors =$fna->creditors;
    $debtor=$fna->debtor;
    $liquidity=$fna->liquidity;
    $worth=$fna->worth;
}
?>

@if( $apprequest ==1)

    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>FINANCIAL ANALYSIS</h4>
                    </div>
                    <div class="widget-content">

                        <div class="row">
                            <div class="col-md-12">
                                <strong>1. Sales</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    @if($sale !=null || $sale !="" )
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3"> {{$sale->date_1}}</th>
                                            <th class="col-md-3">{{$sale->date_2}}</th>
                                            <th class="col-md-3">{{$sale->date_3}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"> </th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                    </tr>
                                    <tr>

                                    @if(count($sale->detail) > 0)
                                        @foreach($sale->detail as $d)
                                            <tr>
                                                <th class="col-md-3">{{$d->data_1}}</th>
                                                <td class="col-md-3">{{$d->data_2}}</td>
                                                <td class="col-md-3">{{$d->data_3}}</td>
                                                <td class="col-md-3">{{$d->data_4}}</td>

                                            </tr>
                                        @endforeach
                                    @endif



                                    <tr>
                                        <td class="col-md-6">Comment with reason, only if
                                            <ol>
                                                <li>The growth rate is errastic.</li>
                                                <li>Any sharp fluctuation in any year.</li>
                                                <li>Any exception performance.</li>
                                            </ol></td>
                                        <td colspan="3" class="col-md-6">@if($sale !="" && $sale != null)<?php echo $sale->comments;?> @endif</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>2. Profitability</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    @if($profitability != null && $profitability != "")
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3">{{$profitability->date_1}}</th>
                                            <th class="col-md-3">{{$profitability->date_2}}</th>
                                            <th class="col-md-3">{{$profitability->date_3}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-3" >Audited</th>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                    </tr>
                                    <tr>

                                    @if(count($profitability->detail) > 0)
                                        @foreach($profitability->detail as $d)
                                            <tr>
                                                <th class="col-md-3">{{$d->data_1}}</th>
                                                <td class="col-md-3">{{$d->data_2}}</td>
                                                <td class="col-md-3">{{$d->data_3}}</td>
                                                <td class="col-md-3">{{$d->data_4}}</td>

                                            </tr>
                                        @endforeach
                                    @endif


                                    <tr>
                                        <td class="col-md-6">Comment with reason, only if
                                            <ol>
                                                <li>The growth rate is errastic.</li>
                                                <li>Any sharp fluctuation in any year.</li>
                                                <li>Any exception performance.</li>
                                            </ol></td>
                                        <td colspan="3" class="col-md-6">@if($profitability !=null & $profitability != "" )<?php echo $profitability->comments;?> @endif</td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <strong>3. Gearing</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    @if($gearing != "" && $gearing != null)
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3">{{$gearing->date_1}}</th>
                                            <th class="col-md-3">{{$gearing->date_2}}</th>
                                            <th class="col-md-3">{{$gearing->date_3}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                    </tr>

                                    @if(count($gearing->detail) > 0)
                                        @foreach($gearing->detail as $d)
                                            <tr>
                                                <th class="col-md-3">{{$d->data_1}}</th>
                                                <td class="col-md-3">{{$d->data_2}}</td>
                                                <td class="col-md-3">{{$d->data_3}}</td>
                                                <td class="col-md-3">{{$d->data_4}}</td>

                                            </tr>
                                        @endforeach
                                    @endif


                                    <tr>
                                        <td class="col-md-6">Comment with reason, only if
                                            <ol>
                                                <li>The ratio is deteriorating and </li>
                                                <li>If convenants should be recommended to improve the position.</li>

                                            </ol></td>
                                        <td colspan="3" class="col-md-6">@if($gearing !="" && $gearing !=null)<?php echo $gearing->comments;?> @endif</td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <strong>4. DSCR </strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    @if($dscr !="" && $dscr != null)
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3">{{$dscr->date_1}}</th>
                                            <th class="col-md-3">{{$dscr->date_2}}</th>
                                            <th class="col-md-3">{{$dscr->date_3}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                    </tr>

                                    @if(count($dscr->detail) > 0)
                                        @foreach($dscr->detail as $d)
                                            <tr>
                                                <th class="col-md-3">{{$d->data_1}}</th>
                                                <td class="col-md-3">{{$d->data_2}}</td>
                                                <td class="col-md-3">{{$d->data_3}}</td>
                                                <td class="col-md-3">{{$d->data_4}}</td>

                                            </tr>

                                        @endforeach

                                    @endif

                                    <tr>
                                        <td class="col-md-6">Is it adwquate to cover fresh borrowings</td>
                                        <td colspan="3" class="col-md-6">@if($dscr != "" && $dscr !=null)<?php echo $dscr->comments; ?> @endif</td>
                                    </tr>
                                </table>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <strong>5.Creditors</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    @if($creditors != null && $creditors !="")
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3">{{$creditors->date_1}}</th>
                                            <th class="col-md-3">{{$creditors->date_2}}</th>
                                            <th class="col-md-3">{{$creditors->date_3}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                    </tr>

                                    @if(count($creditors->detail) > 0)
                                        @foreach($creditors->detail as $d)
                                            <tr>
                                                <th class="col-md-3">{{$d->data_1}}</th>
                                                <td class="col-md-3">{{$d->data_2}}</td>
                                                <td class="col-md-3">{{$d->data_3}}</td>
                                                <td class="col-md-3">{{$d->data_4}}</td>

                                            </tr>
                                        @endforeach
                                    @endif


                                    <tr>
                                        <td class="col-md-6">Comment with reason, only if
                                            <ol>
                                                <li>the ratio is deteriorating,</li>
                                                <li>If sharp variance, do an age analysis</li>

                                            </ol></td>
                                        <td colspan="3" class="col-md-6">@if($creditors !="" && $creditors != null)<?php echo $creditors->comments;?> @endif</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>6.Debtors</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    @if($debtor !="" && $debtor !=null)
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3">{{$debtor->date_1}}</th>
                                            <th class="col-md-3">{{$debtor->date_2}}</th>
                                            <th class="col-md-3">{{$debtor->date_3}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <td class="col-md-3"></td>
                                            <td class="col-md-3"></td>
                                            <td class="col-md-3"></td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                    </tr>

                                    @if(count($debtor->detail) > 0)
                                        @foreach($debtor->detail as $d)
                                            <tr>
                                                <th class="col-md-3">{{$d->data_1}}</th>
                                                <td class="col-md-3">{{$d->data_2}}</td>
                                                <td class="col-md-3">{{$d->data_3}}</td>
                                                <td class="col-md-3">{{$d->data_4}}</td>

                                            </tr>
                                        @endforeach
                                    @endif


                                    <tr>
                                        <td class="col-md-6">Comment with reason, only if
                                            <ol>
                                                <li>The ratio is deteriorrating,</li>
                                                <li>if sharp variance, do an age analysis</li>

                                            </ol></td>
                                        <td colspan="3" class="col-md-6">@if($debtor != null && $debtor !="")<?php echo $debtor->comments; ?> @endif</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>7.Liquidity</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    @if($liquidity !="" && $liquidity != null)
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3">{{$liquidity->date_1}}</th>
                                            <th class="col-md-3">{{$liquidity->date_2}}</th>
                                            <th class="col-md-3">{{$liquidity->date_3}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                    </tr>

                                    @if(count($liquidity->detail) > 0)
                                        @foreach($liquidity->detail as $d)
                                            <tr>
                                                <th class="col-md-3">{{$d->data_1}}</th>
                                                <td class="col-md-3">{{$d->data_2}}</td>
                                                <td>{{$d->data_3}}</td>
                                                <td class="col-md-3">{{$d->data_4}}</td>

                                            </tr>
                                        @endforeach
                                    @endif

                                    <tr>
                                        <td class="col-md-6">Comment with reason, only if
                                            <ol>
                                                <li>The ratio are in variance with norms,.</li>
                                                <li>There is exceptional change in trend there on</li>
                                                <li>Any exception performance.</li>
                                            </ol></td>
                                        <td colspan="3" class="col-md-6">
                                            @if($liquidity !="" && $liquidity != null)
                                                <?php echo $liquidity->comments;?>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <strong>8.Tangible Net Worth</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    @if($worth != null && $worth !="")
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3">{{$worth->date_1}}</th>
                                            <th class="col-md-3">{{$worth->date_2}}</th>
                                            <th class="col-md-3">{{$worth->date_3}}</th>
                                        </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2" class="col-md-3">Year</th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                            <th class="col-md-3"></th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                        <th class="col-md-3">Audited</th>
                                    </tr>

                                    @if(count($worth->detail) > 0)
                                        @foreach($worth->detail as $d)
                                            <tr>
                                                <th class="col-md-3">{{$d->data_1}}</th>
                                                <td class="col-md-3">{{$d->data_2}}</td>
                                                <td class="col-md-3">{{$d->data_3}}</td>
                                                <td class="col-md-3">{{$d->data_4}}</td>

                                            </tr>
                                        @endforeach
                                    @endif


                                    @if($worth != null && $worth !="")
                                        <tr>
                                            <td class="col-md-6">Is the company adquately capitalized</td>
                                            <td colspan="3" class="col-md-6"><?php echo $worth->comments;?></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="col-md-6">Is the company adquately capitalized</td>
                                            <td colspan="3" class="col-md-6"></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>


    </div>

@endif
<div class="row" style="margin-left: 20px; margin-bottom: 30px">
    <div class="col-md-12">
        <div class="col-md-2 pull-right">
            <a href="#" data-dismiss="modal"  class="btn btn-success   btn-block"></i>  Ok</a>
        </div>

    </div>
</div>



