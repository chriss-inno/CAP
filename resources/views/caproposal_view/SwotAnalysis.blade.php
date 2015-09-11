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

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tr>
                <td colspan="2" bgcolor="#EEEEEE" class="col-md-12" style="text-align: center" ><strong>D: SWOT ANALYSIS</strong></td>
            </tr>
            <tr>
                <td> <strong>STRENGTH</strong></td>
                <td> <strong>WEAKNESSES</strong></td>
            </tr>
            <tr>
                <td> <?php echo $swot_strength; ?></td>
                <td> <?php echo $swot_weaknesses; ?></td>
            </tr>
            <tr>
                <td> <strong>OPPORTUNITIES</strong></td>
                <td> <strong>THREATS</strong></td>
            </tr>
            <tr>
                <td> <?php echo $swot_opportunities; ?></td>
                <td> <?php echo $swot_threats; ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="row" style="margin-left: 20px; margin-bottom: 30px">
    <div class="col-md-12">
        <div class="col-md-2 pull-right">
            <a href="#" data-dismiss="modal"  class="btn btn-success btn-block">  Ok</a>
        </div>

    </div>
</div>

{!! Form::close() !!}
