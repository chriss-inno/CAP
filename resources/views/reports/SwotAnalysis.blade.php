<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$swot_strength="";
$swot_weaknesses="";
$swot_opportunities="";
$swot_threats="";
$swot_issues="";

if( count($crp->swotanalysis) !=0 )
{

    $id=$crp->swotanalysis->id;
    $swot_strength=$crp->swotanalysis->swot_strength;
    $swot_weaknesses=$crp->swotanalysis->swot_weaknesses;
    $swot_opportunities=$crp->swotanalysis->swot_opportunities;
    $swot_threats=$crp->swotanalysis->swot_threats;

    $apprequest=1;
}
?>
<!-- Bootstrap -->
{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
<div class="container">
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <td colspan="2" bgcolor="#EEEEEE" class="col-md-12"  style="text-align: center" ><strong>D: SWOT ANALYSIS</strong></td>
            </tr>
            <tr>
                <td class="col-md-3"> <strong>STRENGTH</strong></td>
                <td class="col-md-9"> <strong>WEAKNESSES</strong></td>
            </tr>
            <tr>
                <td> <?php echo $swot_strength; ?></td>
                <td> <?php echo $swot_weaknesses; ?></td>
            </tr>
            <tr>
                <td class="col-md-3"> <strong>OPPORTUNITIES</strong></td>
                <td class="col-md-9"> <strong>THREATS</strong></td>
            </tr>
            <tr>
                <td class="col-md-3"> <?php echo $swot_opportunities; ?></td>
                <td class="col-md-9"> <?php echo $swot_threats; ?></td>
            </tr>
        </table>
    </div>
</div>
</div>