<?php
//Get profile


$sno = $crp->sno;
$app_date=$crp->app_date;
$open_type=$crp->open_type;
$app_type=$crp->app_type;
$ac_name=$crp->ac_name;
$acaddress=$crp->ac_address;

$crid=$crp->id;
$apprequest =0;
$id=0;

$borrowerid="";
$credit_rating="";
$legal_entity="";
$business_activity="";
$g_indicator ="";
$group ="";
$emanagement="";
$cr_bankers ="";
$shareholders ="";
$directors ="";

if( count($crp->accountprofile) !=0)
{
    $apprequest =1;

    $borrowerid=$crp->accountprofile->borrowerid;
    $credit_rating=$crp->accountprofile->credit_rating;
    $legal_entity=$crp->accountprofile->legal_entity;
    $business_activity =$crp->accountprofile->business_activity;
    $g_indicator =$crp->accountprofile->g_indicator;
    $group =$crp->accountprofile->app_group;
    $emanagement =$crp->accountprofile->emanagement;

    $cr_bankers =$crp->accountprofile->borrowerid;
    $shareholders =$crp->shareholders;
    $directors =$crp->directors;
    $cr_bankers =$crp->currentbankers;


    $id= $crp->accountprofile->id;
}

?>

<!-- Bootstrap -->
{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered" border="0">
                <tr>
                    <td colspan="4" bgcolor="#EEEEEE" class="col-md-12" ><strong>A: Account profile</strong></td>
                </tr>
                <tr>
                    <td width="22%" class="col-md-4" bgcolor="#EEEEEE"><strong>Borrower ID: </strong ></td>
                    <td width="13%" class="col-md-2">{{$borrowerid}}</td>
                    <td width="25%" bgcolor="#EEEEEE" class="col-md-4"><strong>Credit rating:</strong ></td>
                    <td width="40%" class="col-md-2">{{$credit_rating}}</td>
                </tr>
                <tr>
                    <td  class="col-md-3"><strong>Legal Entity</strong></td>
                    <td colspan="3" class="col-md-9">{{ $legal_entity }}</td>
                </tr>
                <tr>
                    <td  class="col-md-3"><strong>Business activity</strong></td>
                    <td colspan="3" class="col-md-9">{{$business_activity}}</td>
                </tr>
                <tr>
                    <td colspan="2"  class="col-md-3"><strong>Group</strong></td>
                    <td  class="col-md-2">{{$g_indicator}};</td>
                    <td  class="col-md-7">{{$group}}</td>
                </tr>
                @if( $shareholders !=NULL && sizeof($shareholders) >0)
                    <tr>
                        <td rowspan="{{count($shareholders) +2}}"  class="col-md-3"><strong>Shareholders</strong></td>
                        <td colspan="2" bgcolor="#EEEEEE" class="col-md-7"><strong>Name</strong></td>
                        <td bgcolor="#EEEEEE" class="col-md-2"><strong>% Holding</strong></td>
                    </tr>
                   <?php $tsh=0; ?>
                    @foreach($shareholders as $sh)
                        <tr>
                            <td colspan="2" class="col-md-9">{{$sh->name}}</td>
                            <td class="col-md-9">{{$sh->holding}}</td>
                        </tr>
                        <?php $tsh += $sh->holding;?>
                    @endforeach
                    <tr>
                        <td colspan="2" class="col-md-9 text-right"><strong>Total</strong></td>
                        <td class="col-md-9"><strong>{{$tsh}}</strong></td>
                    </tr>

                @endif
                @if( $directors !=NULL && sizeof($directors) >0)
                    <tr>
                        <td  rowspan="{{count($directors) +1 }}" class="col-md-3" ><strong>Directors</strong></td>
                        <td bgcolor="#EEEEEE" class="col-md-9" colspan="3"><strong>Full Name</strong> </td>
                    </tr>
                    @foreach($directors as $dr)

                        <tr>
                            <td class="col-md-9" colspan="3">{{$dr->fullname}}</td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td class="col-md-3" ><strong>Executive management</strong></td>
                    <td class="col-md-9" colspan="3">{{$emanagement}}</td>
                </tr>
                @if( $cr_bankers !=NULL && sizeof($cr_bankers) >0)
                    <tr>
                        <td  rowspan="{{count($cr_bankers) +1}}" class="col-md-3" ><strong>Current Banker</strong></td>
                        <td bgcolor="#EEEEEE" class="col-md-9" colspan="3"><strong>Name</strong></td>
                    </tr>
                    @foreach($cr_bankers as $b)
                        <tr>
                            <td class="col-md-9" colspan="3">{{$b->bankname}}</td>
                        </tr>
                    @endforeach
                @endif
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
