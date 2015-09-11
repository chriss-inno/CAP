<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$sales_distributions="";
$credit_terms="";
$product_traded="";
$org_hq="";
$business_activity="";

if( count($crp->businessactivity) !=0 )
{
    $sales_distributions=$crp->businessactivity->sales_distributions;
    $credit_terms=$crp->businessactivity->credit_terms;
    $product_traded=$crp->businessactivity->product_traded;
    $org_hq=$crp->businessactivity->org_hq;
    $business_activity=$crp->businessactivity->business_activity;
    $id=$crp->businessactivity->id;
    $apprequest=1;
}
?>
<div class="row">
    <table class="table table-bordered">
        <tr>
            <td colspan="2" bgcolor="#EEEEEE" class="col-md-12"  style="text-align: center" ><strong>A: BUSINESS ACTIVITY</strong></td>
        </tr>
        <tr>
            <td colspan="2"> <?php echo $business_activity; ?></td>

        </tr>
        <tr>
            <td>     <strong>Organization Headquarters and hubs</strong>
                <p><ol>
                    <li>Location of the HO.</li>
                    <li>Location of the central yard.</li>
                    <li>Project site office.</li>
                </ol></p></td>
            <td><?php echo $org_hq; ?></td>

        </tr>
        <tr>
            <td>  <strong>Products Traded</strong>
                <p><ol>
                    <li>List of the products, the parent company of the products, and their share in the company Turnover, Local or imported.</li>
                </ol></p></td>
            <td><?php echo $product_traded; ?></td>
        </tr>
        <tr>
            <td>Procurement and Credit terms</strong>
                <p><ol>
                    <li>Mostly imported or local. What is the % of import content.</li>
                    <li>Any fixed supply arrangement with any supplier.</li>
                    <li>Name  important suppliers.</li>
                </ol></p></td>
            <td><?php echo $credit_terms; ?></td>
        </tr>
        <tr>
            <td> <strong>Sales and Distribution</strong>
                <p><ol>
                    <li>How is the contract procured. Who  or which department handles the biding process</li>
                    <li>Does the company have adequate skilled manpower.</li>
                    <li>Main clients , percentage of sales contributed</li>
                </ol></p></td>
            <td><?php echo $sales_distributions; ?></td>
        </tr>
    </table>
</div>
<div class="row" style="margin-left: 20px; margin-bottom: 30px">
    <div class="col-md-12">
        <div class="col-md-2 pull-right">
            <a href="#" data-dismiss="modal"  class="btn btn-success btn-block">   Ok</a>
        </div>

    </div>
</div>

{!! Form::close() !!}
