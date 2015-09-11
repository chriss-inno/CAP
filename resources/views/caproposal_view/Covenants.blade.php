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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-full-width">
                <tr>
                    <th  bgcolor="#EEEEEE" class="col-md-4">(D)</th>
                    <th colspan="3" align="center" bgcolor="#EEEEEE" class="col-md-10">COVENANTS</th>
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
    <div class="row" style="margin-top: 10px; margin-bottom:20px">
        <div class="col-md-12">
            <div class="col-md-2 pull-right">
                <a href="#" data-dismiss="modal"  class="btn btn-success btn-block">   Ok </a>
            </div>
        </div>
    </div>
</div>
