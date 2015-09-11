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
{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<div class="container">
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
                        <p>
                        <ol>
                            <li>If the earnings in fees and commission adequately supplement the interest income.</li>
                            <li>Is there any other reason to justify the proposed pricing- competition, market condition</li>
                            <li>Comment if there is any exceptions to the pricing grid as mentioned in the credit grading norm and the credit policy</li>
                        </ol>
                        </p></td>
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
    <div class="row">
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

