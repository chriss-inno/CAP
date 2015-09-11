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
            <table class="table table-bordered">
                <tr>
                    <td colspan="4" bgcolor="#FFFFFF" class="col-md-12" style="text-align: center" ><strong>BANK M (TANZANIA) PLC </strong></td>
                </tr>
                <tr>
                    <td  bgcolor="#EEEEEE" class="col-md-4"  ><strong>CREDIT PROPOSAL</strong></td>
                    <td colspan="2" bgcolor="#EEEEEE" class="col-md-6"  ><strong>SERIAL NUMBER:{{$crp->sno}} </strong></td>
                    <td  class="col-md-2" style="text-align: center" ><strong>{{date('jS F, Y ',strtotime($crp->app_date))}}</strong></td>
                </tr>
                <tr>
                    <td bgcolor="#EEEEEE"><strong>ACCOUNT NAME</strong> </td>
                    <td colspan="3" ><strong>{{$crp->customer->customer_name}}</strong> </td>
                </tr>
                <tr>
                    <td bgcolor="#EEEEEE"><strong>ADDRESS</strong> </td>
                    <td colspan="3" ><strong><?php echo $crp->customer->customer_address; ?></strong> </td>
                </tr>
                <tr>
                    <td bgcolor="#EEEEEE"><strong>MANAGEMENT CONTACT PERSON</strong> </td>
                    <td colspan="3" ><strong>{{$crp->customer->contact_person}}</strong> </td>
                </tr>
                <tr>
                    <td bgcolor="#EEEEEE"><strong>RELATIONSHIP MANAGER</strong> </td>
                    <td colspan="3" ><strong>{{$crp->customer->rm}}</strong> </td>
                </tr>
                <tr>
                    <td colspan="4" bgcolor="#EEEEEE" class="col-md-12" style="text-align: center" ><strong>A: ACCOUNT PROFILE</strong></td>
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
                    <td colspan="3" class="col-md-9"><?php echo $business_activity; ?></td>
                </tr>
                <tr>
                    <td colspan="2"  class="col-md-3"><strong>Group</strong></td>
                    <td  class="col-md-2">{{$g_indicator}}</td>
                    <td  class="col-md-7">{{$group}}</td>
                </tr>
                <?php $tsh=0; ?>
                @if( $shareholders !=NULL && sizeof($shareholders) >0)
                    <tr>
                        <td rowspan="{{count($shareholders) +2}}"  class="col-md-3"><strong>Shareholders</strong></td>
                        <td colspan="2" bgcolor="#EEEEEE" class="col-md-7"><strong>Name</strong></td>
                        <td bgcolor="#EEEEEE" class="col-md-2"><strong>% Holding</strong></td>
                    </tr>
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
