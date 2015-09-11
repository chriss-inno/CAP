<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$title="";
$contents="";
$annexure="";

if( count($crp->annexure_i) !=0 )
{
    $annexure=$crp->annexure_i;
    $title=$annexure->title;
    $contents=$annexure->contents;
    $id=$annexure->id;
    $apprequest=1;

}
        ?>
<div class="container">
    <div class="row">
        <div class="col-md-12"><strong> Annexure II <?php echo " - ".$title; ?></strong></div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-md-12"><?php echo $contents;; ?></div>
    </div>
    <div class="row" style="margin-left: 20px; margin-bottom: 30px">
        <div class="col-md-12">
            <div class="col-md-2 pull-right">
                <a href="#" data-dismiss="modal"  class="btn btn-success btn-block">   Ok</a>
            </div>

        </div>
    </div>
</div>