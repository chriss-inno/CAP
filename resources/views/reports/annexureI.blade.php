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

{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<div class="container">
    <div class="row">
        <div class="col-md-12"><strong> Annexure I <?php echo " - ".$title; ?></strong></div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-md-12"><?php echo $contents;; ?></div>
    </div>
</div>