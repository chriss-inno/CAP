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

<table class="table" border="0" style="border: 1px solid #000">
    <tr>
        <td width="137" >A:</td>
        <td colspan="3" >Account profile</td>
    </tr>
    <tr>
        <td ><strong> Borrower ID: </strong ></td>
        <td width="106" >{{$borrowerid}}</td>
        <td width="62" ><strong>Credit rating:  </strong ></td>
        <td width="149" ><strong> {{$credit_rating}}</strong></td>
    </tr>
    <tr>
        <td >Legal Entity</td>
        <td  colspan="3">{{ $legal_entity }}</td>
    </tr>
    <tr>
        <td >Business activity</td>
        <td  colspan="3">{{$business_activity}}</td>
    </tr>
    <tr>
        <td >Group</td>
        <td >{{$g_indicator}}</td>
        <td  colspan="2">{{$group}}</td>
    </tr>
    <tr>
        <td rowspan="2" >Shareholders</td>
        <td  colspan="2"><strong>Name</strong></td>
        <td><strong>% Holding</strong></td>
    </tr>
    <?php $sh_count =0; $sh_data="";
    if( $shareholders !=NULL && sizeof($shareholders) >0){
    foreach($shareholders as $sh)
    {?>
    <tr>
        <td  colspan="2">{{$sh->name}}</td>
        <td>{{$sh->holding}}</td>
    </tr>
    <?php  }

    }
    ?>
    <tr>
        <td rowspan="3" >Directors</td>
        <td  colspan="3">
        </td>
    </tr>
    <?php $dr_count =0; $dr_data="";
    if( $directors !=NULL && sizeof($directors) >0){


    foreach($directors as $dr){
    ?>
    <tr>
        <td  colspan="3">{{$dr->fullname}}</td>
    </tr>
    <?php
    }
    }

    ?>
    <tr>
        <td >Executive management</td>
        <td  colspan="3">{{$emanagement}}</td>
    </tr>
    <tr>
        <td >Current Banker</td>
        <td  colspan="3">
            <table class="table" id="cr_bankers" width="100%">
                <thead>

                </thead>
                <tbody>
                <?php
                if( $cr_bankers !=NULL && sizeof($cr_bankers) >0)
                {


                    foreach($cr_bankers as $b){

                        echo ' <tr>
                                                        <td >'.$b->bankname.'</td>
                                                        <td > </td>
                                                    </tr>
                                                   ' ;

                    }

                }

                ?>
                </tbody>

            </table>
        </td>
    </tr>

</table>
/