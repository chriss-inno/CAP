<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$political_economic="";
$sector_performance="";
$position_sector="";
$regulatory="";
$environmental_issues="";

if( count($crp->environment) !=0 )
{

    $id=$crp->environment->id;
    $political_economic=$crp->environment->political_economic;
    $sector_performance=$crp->environment->sector_performance;
    $position_sector=$crp->environment->position_sector;
    $regulatory=$crp->environment->regulatory;
    $environmental_issues=$crp->environment->environmental_issues;
    $apprequest=1;
}
?>
<!-- Bootstrap -->
{!!HTML::style('bootstrap/css/bootstrap.min.css')!!}
@if( count($crp->environment) !=0 )
    <div class="page">
        <div class="container">

            <div class="row">
                <table class="table table-bordered">
                    <tr>
                        <td colspan="2" bgcolor="#EEEEEE" class="col-md-12"  style="text-align: center" ><strong>B: Environment</strong></td>
                    </tr>
                    <tr>
                        <td class="col-md-3">  <strong>Political and economic </strong>
                            <p><ol>
                                <li>General economic environment – GDP growth rate, industrial climate, state of infrastructure, Political stability</li>
                            </ol>
                            </p></td>
                        <td class="col-md-9"><?php echo $political_economic; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-3"> <strong>Sector (industry) Performance</strong>
                            <p><ol>
                                <li>Is the sector growth rate in sync with the growth in the national economy - what is the growth rate - is it steady.</li>
                            </ol></p></td>
                        <td class="col-md-9"><?php echo $sector_performance; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-3">  <strong>Position within business sector / industry</strong>
                            <p><ol>
                                <li>Market share / position.</li>
                                <li>Is it steady, declining, improving?</li>
                                <li>Any specific strategies to improve it.</li>
                                <li>Name the main competitors, if possible with their market share</li>
                            </ol></p></td>
                        <td class="col-md-9"><?php echo $position_sector; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-3"> <strong>Regulatory</strong>
                            <p>
                            <ol>
                                <li>Any regulatory body governing the sector, name it.</li>
                                <li>Is there any fresh directive from such bodies or Govt current or imminent to affect business either positively or negatively.</li>
                            </ol>
                            </p></td>
                        <td class="col-md-9"><?php echo $regulatory; ?></td>
                    </tr>
                    <tr>
                        <td class="col-md-3"> <strong>Ecological / Environmental issues</strong>
                            <p><ol>
                                <li>If the operation of the company have any environmental impact.</li>
                                <li>If the company has all the clearances from the respective authorities</li>
                            </ol></p></td>
                        <td class="col-md-9"><?php echo $environmental_issues; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endif