<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$covs="";
$pricing="";
$disbursal="";
$appraisal_fee_3="";
$appraisal_fee_2="";
$appraisal_fee_1="";

if( count($crp->covenants) !=0 )
{
    $covs=$crp->covenants;
    $pricing=$crp->covenants->pricing;
    $disbursal=$covs->disbursal;
    $appraisal_fee_1=$covs->appraisal_fee_1;
    $appraisal_fee_2=$covs->appraisal_fee_2;
    $appraisal_fee_3=$covs->appraisal_fee_3;
    $id=$covs->id;
    $apprequest=1;

}
?>

{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table cellpadding="0" cellspacing="0" style=" border: 1px solid #ddd;" border="1" width="100%">
                <tr>
                    <th colspan="4" align="center" bgcolor="#EEEEEE" class="col-md-10" style="text-align: center"> (D) COVENANTS</th>
                </tr>
                <tr>
                    <td class="col-md-3"><strong>Pricing</strong></td>
                    <td class="col-md-3"><strong>Facility</strong></td>
                    <td class="col-md-3"><strong>Spread</strong></td>
                    <td class="col-md-3"><strong>Effective rate</strong></td>
                </tr>
                @if(count($pricing) > 0 && $pricing != null)
                    <?php $c=0; ?>
                    @foreach($pricing as $pc)
                            @if($pc->fund_type =="Funded")
                                <tr>
                                    <td><strong><small>Rate of Interest</small></strong></td>
                                    <td><strong><small>Funded</small></strong></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td>{{$pc->pricing}}</td>
                                    <td>{{$pc->facility}}</td>
                                    <td>{{$pc->spread}}</td>
                                    <td>{{$pc->effective_rate}}</td>

                                </tr>
                            @else
                                @if($pc->type_nonfunded !="")
                                    <tr>
                                        <td></td>
                                        <td><strong>{{$pc->type_nonfunded}}</strong></td>
                                        <td>{{$pc->nonfunded_spread}}</td>
                                        <td>{{$pc->nonfunded_ef_rate}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{$pc->pricing}}</td>
                                    <td>{{$pc->facility}}</td>
                                    <td>{{$pc->spread}}</td>
                                    <td>{{$pc->effective_rate}}</td>

                                </tr>
                            @endif
                    @endforeach
                @endif
                <tr>
                    <td class="col-md-4"><strong>Appraisal fee</strong></td>
                    <td class="col-md-4">{{$appraisal_fee_1}}</td>
                    <td class="col-md-4">{{$appraisal_fee_2}}</td>
                    <td class="col-md-4">{{$appraisal_fee_3}}</td>
                </tr>
                <tr>
                    <td class="col-md-4"><strong>Disbursal</strong></td>
                    <td colspan="3" class="col-md-8"><?php echo $disbursal; ?></td>
                </tr>


            </table>
        </div>
    </div>

</div>
<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$pric="";
$details="";
$coments="";

if( count($crp->pricingrationale) >0 )
{
    $apprequest=1;
    $pric=$crp->pricingrationale;
    $id=$pric->id;
    $details=$pric->details;
    $coments=$pric->coments;
}
?>
<div class="container" style="margin-top: 10px;">
    <div class="row">
        <div class="col-md-12">
            <table cellpadding="0" cellspacing="0" style=" border: 1px solid #ddd;" border="1" width="100%">
                <tr>
                    <th colspan="3" align="center" bgcolor="#EEEEEE" class="col-md-10" style="text-align: center">(E) PRICING RATIONALE</th>
                </tr>
                <tr>
                    <th colspan="3" class="col-md-12"> <h3>Account profitability  estimated at 80% utilization of the overdraft)
                            <small>Figures in TZS "mio"</small>
                        </h3></th>
                </tr>
                <tr>
                    <th  class="col-md-4">Facility</th>
                    <th class="col-md-4">Total annual interest</th>
                    <th class="col-md-4">Fees</th>
                </tr>
                @if($details !="" && count($details) >0)
                    <?php
                    $anual_interestT=0;
                    $feesT=0;
                    ?>
                    @foreach($details as $dt)
                        <?php
                        $anual_interestT +=$dt->anual_interest;
                        $feesT +=$dt->fees;
                        ?>
                        <tr>
                            <td  class="col-md-4">{{$dt->facility}}</td>
                            <td  class="col-md-4">{{$dt->anual_interest}}</td>
                            <td  class="col-md-4">{{$dt->fees}}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td align="right"  class="col-md-4"><strong>Total</strong></td>
                        <td  class="col-md-4"><strong>{{$anual_interestT}}</strong></td>
                        <td  class="col-md-4"><strong>{{$feesT}}</strong></td>
                    </tr>
                @endif
                <tr>
                    <td valign="top"  class="col-md-4">
                        <ol>
                            <li>If the earnings in fees and commission adequately supplement the interest income.</li>
                            <li>Is there any other reason to justify the proposed pricing- competition, market condition</li>
                            <li>Comment if there is any exceptions to the pricing grid as mentioned in the credit grading norm and the credit policy</li>
                        </ol>
                       </td>
                    <td colspan="2" valign="top"  class="col-md-8"><?php echo $coments;?></td>
                </tr>

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
            <table class="table table-bordered">
                <tr>
                    <td>
                        <div class="col-md-6">
                            @if($crSignatories !=""  && count($crSignatories)>0 )
                                @foreach($crSignatories as $sig)
                                    <p>{{$sig->names}}-{{$sig->designation}} </p>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-6"><p>&nbsp;&nbsp;</p></div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>


