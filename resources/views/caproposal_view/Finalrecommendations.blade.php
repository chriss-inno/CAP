<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$fr="";
$fcl="";
if( count($crp->facilitystructure) >0 )
{
    $fr=$crp->facilitystructure->finalrecommendations;

    $apprequest=1;
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <tr>
                    <th   bgcolor="#EEEEEE" class="col-md-3">(G)</th>
                    <th  align="center" bgcolor="#EEEEEE" class="col-md-9">Final recommendations</th>
                </tr>
                @if( $fr != null && count($fr) != 0 )
                    @if( count($fr) >0 )
                        @foreach($fr as $frec)

                            <tr>
                                <td class="col-md-2"> <strong>Facility</strong></td>
                                <td class="col-md-10"> {{ $frec->facility}} @if($frec->facility_comments !="") - {{$frec->facility_comments}} @endif</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">Amount</td>
                                <td class="col-md-10"> {{ $frec->amount}}</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">Tenor</td>
                                <td class="col-md-10"> {{ $frec->tenor}}</td>
                            </tr>
                            <tr>
                                <td class="col-md-2"> @if( \App\Http\Controllers\FinalRecommendationsController::checkOverdraft($frec->facility) )
                                        Rate of interest/commission
                                    @else
                                        Rate of interest/commission
                                    @endif</td>
                                <td class="col-md-10"> {{ $frec->rate_interest}}</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">Credit rating and pricing</td>
                                <td class="col-md-10">
                                    {{ $frec->cr_pricing}}
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-2">Repayment</td>
                                <td class="col-md-10"> {{ $frec->repayment}}</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">Facility fee</td>
                                <td class="col-md-10"> {{ $frec->facility_fee}}</td>
                            </tr>
                            <tr>
                                <td class="col-md-2">Review Date</td>
                                <td class="col-md-10"> {{ $frec->review_date}}</td>
                            </tr>
                        @endforeach
                    @endif
                @endif

            </table>
        </div>
    </div>
    <div class="row" style="margin-top: 10px; margin-bottom:20PX">
        <div class="col-md-12">
            <div class="col-md-2 pull-right">
                <a href="#" data-dismiss="modal"  class="btn btn-success btn-block">   Ok </a>
            </div>
        </div>
    </div>
</div>