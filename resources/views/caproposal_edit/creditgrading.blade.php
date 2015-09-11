<?php
$crid=$crp->id;
$apprequest =0;

$id=0;
$qanalysis=array();
$qntanalysis=array();
$crg="";
if( count($crp->creditRiskGrading) >0 )
{
    $apprequest=1;
    $crg=$crp->creditRiskGrading;
    $id=$crg->id;
    $qanalysis=$crg->qanalysis;
    $qntanalysis=$crg->qntanalysis;
}
$rules = ['business_activity'=>'alpha_dash','org_hq'=>'alpha_dash','sales_distributions'=>'alpha_dash','credit_terms'=>'alpha_dash','product_traded'=>'alpha_dash'];
?>
{!! Form::open(array('url' => 'credit-grading', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
<div class="row row-bg">
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>CREDIT RISK GRADING</h4>
                </div>
                <div class="widget-content">
                    @if(count($qntanalysis)> 0 &&  $qntanalysis !="")
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-12" >
                                <strong>(A) QUANTITATIVE ANALYSIS </strong>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12"><table class="table table-bordered" >
                           <tr>
                               <th>Ratios:</th>
                               <th>AAA</th>
                               <th>AA</th>
                               <th>A</th>
                               <th>BB</th>
                               <th>B</th>
                               <th>C</th>
                               <th>D</th>
                           </tr>
                           <?php 
						        $Current_Ratio="";
								$Debt_Service ="";
								$Dept_Equity="";
								$Asset_Coverage="";
								$Security_Cove="";
								$Operation_Profit="";
								$Current_Ratio_name="";
								$Debt_Service_name ="";
								$Dept_Equity_name="";
								$Asset_Coverage_name="";
								$Security_Cove_name="";
								$Operation_Profit_name="";

                                  foreach($qntanalysis as $qn)
                                      {
                                          $Current_Ratio=$qn->Current_Ratio;
                                          $Debt_Service =$qn->Debt_Service;
                                          $Dept_Equity=$qn->Dept_Equity;
                                          $Asset_Coverage=$qn->Asset_Coverage;
                                          $Security_Cove=$qn->Security_Cove;
                                          $Operation_Profit=$qn->Operation_Profit;

                                      }

						   ?>

                           <tr>
                               <td class="col-md-3"> Current Ratio/Current Assets/ Liabilities  </td>
                               <td align="center"><input name="Current_Ratio" type="radio"  @if($Current_Ratio=="1") checked="checked" @endif  value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >2.5</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio"  @if($Current_Ratio=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> >2</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio"  @if($Current_Ratio=="3") checked="checked" @endif  value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >1.75</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio"  @if($Current_Ratio=="4") checked="checked" @endif  value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio"  @if($Current_Ratio=="5") checked="checked" @endif  value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >1.25</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio"  @if($Current_Ratio=="6") checked="checked" @endif  value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> >1</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio"  @if($Current_Ratio=="7") checked="checked" @endif value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> <1</label> </td>
                           </tr>

                           <tr>
                               <td class="col-md-3">Debt Service Coverage Ration (DSCR) Debt repayment obligation/ EBITDAY (gross profit) </td>
                               <td align="center"><input type="radio" name="Debt_Service"  @if($Debt_Service=="1") checked="checked" @endif  value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >2.5</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" @if($Debt_Service=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> >2</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" @if($Debt_Service=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" @if($Debt_Service=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >1.25</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" @if($Debt_Service=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >1</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" @if($Debt_Service=="6") checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> =1</label> </td>

                               <td align="center"><input type="radio" name="Debt_Service" @if($Debt_Service=="7") checked="checked" @endif value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> <1</label> </td>
                           </tr>
                           <tr>
                               <td class="col-md-3">Dept -Equity long term Debt /Shareholder funds  </td>
                               <td align="center"><input type="radio" name="Dept_Equity" @if($Dept_Equity=="1") checked="checked" @endif value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> <1</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" @if($Dept_Equity=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> <1.5</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" @if($Dept_Equity=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"><1.5</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" @if($Dept_Equity=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> <2.5</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" @if($Dept_Equity=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"><2.5</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" @if($Dept_Equity=="6") checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"><3</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" @if($Dept_Equity=="7") checked="checked" @endif value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> >3</label> </td>
                           </tr>
                           <tr>
                               <td class="col-md-3">Asset Coverage Fixed Assets /Dept  </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" @if($Asset_Coverage=="1") checked="checked" @endif value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >4</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" @if($Asset_Coverage=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> >3</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" @if($Asset_Coverage=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >2.5</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" @if($Asset_Coverage=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >2</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" @if($Asset_Coverage=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" @if($Asset_Coverage=="6") checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> >1</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" @if($Asset_Coverage=="7") checked="checked" @endif value=7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> <1</label> </td>
                           </tr>
                           <tr>
                               <td class="col-md-3">Security Cove FSV / Loan under the security  </td>
                               <td align="center"><input type="radio" name="Security_Cove" @if($Security_Cove=="1") checked="checked" @endif value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >3</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" @if($Security_Cove=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> >2</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" @if($Security_Cove=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >1.75</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" @if($Security_Cove=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" @if($Security_Cove=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >1.25</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" @if($Security_Cove=="6" ) checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> >1</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" @if($Security_Cove=="7") checked="checked" @endif value=7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> <1</label> </td>
                           </tr>
                           <tr>
                               <td class="col-md-3">Operation Profit   </td>
                               <td align="center"><input type="radio" name="Operation_Profit"  @if($Operation_Profit=="1") checked="checked" @endif value="1" id="q_aaa" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >2.5</label> </td>
                               <td align="center"><strong>
                               <input type="radio" name="Operation_Profit" @if($Operation_Profit=="2") checked="checked" @endif value="2" id="q_aa" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                               </strong>
                                   <label for="aa"> >2</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" @if($Operation_Profit=="3") checked="checked" @endif value="3" id="q_a" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >1.75</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" @if($Operation_Profit=="4") checked="checked" @endif value="4" id="q_bb" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" @if($Operation_Profit=="5") checked="checked" @endif value="5" id="q_b" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >10%5</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" @if($Operation_Profit=="6") checked="checked" @endif value="6" id="q_" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> >10</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" @if($Operation_Profit=="7") checked="checked" @endif  value="7" id="q_" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="q_d">Loss</label> </td>
                           </tr>
                          
                           <tr>
                               <td class="col-md-3"><strong>Weight</strong></td>
                               <td align="center"><strong>7</strong></td>
                               <td align="center"><strong>6</strong></td>
                               <td align="center"><strong>5</strong></td>
                               <td align="center"><strong>4</strong></td>
                               <td align="center"><strong>3</strong></td>
                               <td align="center"><strong>2</strong></td>
                               <td align="center"><strong>1</strong></td>
                           </tr>
                           <tr>
                               <td class="col-md-3"><strong>SCORE </strong> </td>
                               <td align="center"><strong>>42</strong></td>
                               <td align="center"><strong>>36</strong></td>
                               <td align="center"><strong>>30</strong></td>
                               <td align="center"><strong>>24</strong></td>
                               <td align="center"><strong>>18</strong></td>
                               <td align="center"><strong>>12</strong></td>
                               <td align="center"><strong>>6</strong></td>
                           </tr>

                       </table></div>
                        </div>
                       @else
                        
                  <div class="row" style="margin-bottom: 10px;">
                      <div class="col-md-12" >
                          <strong>(A) QUANTITATIVE ANALYSIS </strong>
                      </div>
                  </div>

                <div class="row">
                    <div class="col-md-12"><table class="table table-bordered" >
                           <tr>
                               <th>Ratios:</th>
                               <th>AAA</th>
                               <th>AA</th>
                               <th>A</th>
                               <th>BB</th>
                               <th>B</th>
                               <th>C</th>
                               <th>D</th>
                           </tr>
                          
                           <tr>
                               <td class="col-md-3"> Current Ratio/Current Assets/ Liabilities  </td>
                               <td align="center"><input type="radio" name="Current_Ratio" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >2.5</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> >2</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >1.75</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio" value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >1.25</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> >1</label> </td>
                               <td align="center"><input type="radio" name="Current_Ratio" value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> <1</label> </td>
                           </tr>

                           <tr>
                               <td class="col-md-3">Debt Service Coverage Ration (DSCR) Debt repayment obligation/ EBITDAY (gross profit) </td>
                               <td align="center"><input type="radio" name="Debt_Service" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >2.5</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> >2</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >1.25</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >1</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" value=6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> =1</label> </td>
                               <td align="center"><input type="radio" name="Debt_Service" value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> <1</label> </td>
                           </tr>
                           <tr>
                               <td class="col-md-3">Dept -Equity long term Debt /Shareholder funds  </td>
                               <td align="center"><input type="radio" name="Dept_Equity" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> <1</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> <1.5</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"><1.5</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> <2.5</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" value=5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"><2.5</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"><3</label> </td>
                               <td align="center"><input type="radio" name="Dept_Equity" value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> >3</label> </td>
                           </tr>
                           <tr>
                               <td class="col-md-3">Asset Coverage Fixed Assets /Dept  </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >4</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> >3</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >2.5</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >2</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> >1</label> </td>
                               <td align="center"><input type="radio" name="Asset_Coverage" value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> <1</label> </td>
                           </tr>
                           <tr>
                               <td class="col-md-3">Security Cove FSV / Loan under the security  </td>
                               <td align="center"><input type="radio" name="Security_Cove" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >3</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aa"> >2</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >1.75</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >1.25</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> >1</label> </td>
                               <td align="center"><input type="radio" name="Security_Cove" value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="d"> <1</label> </td>
                           </tr>
                           <tr>
                               <td class="col-md-3">Operation Profit  </td>
                               <td align="center"><input type="radio" name="Operation_Profit" value="1" id="q_aaa" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="aaa"> >2.5</label> </td>
                               <td align="center"><strong>
                               <input type="radio" name="Operation_Profit" value="2" id="q_aa" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                               </strong>
                                   <label for="aa"> >2</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" value="3" id="q_a" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="a"> >1.75</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" value="4" id="q_bb" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="bb"> >1.5</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" value="5" id="q_b" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="b"> >10%5</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" value="6" id="q_" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="c"> >10</label> </td>
                               <td align="center"><input type="radio" name="Operation_Profit" value="7" id="q_" style="width: 20px; height: 20px; float: left; margin-right: 5px">
                             <label for="q_d">Loss</label> </td>
                           </tr>
                           
                           <tr>
                               <td class="col-md-3"><strong>Weight</strong></td>
                               <td align="center"><strong>7</strong></td>
                               <td align="center"><strong>6</strong></td>
                               <td align="center"><strong>5</strong></td>
                               <td align="center"><strong>4</strong></td>
                               <td align="center"><strong>3</strong></td>
                               <td align="center"><strong>2</strong></td>
                               <td align="center"><strong>1</strong></td>
                           </tr>
                           <tr>
                               <td class="col-md-3"><strong>SCORE </strong> </td>
                               <td align="center"><strong>>42</strong></td>
                               <td align="center"><strong>>36</strong></td>
                               <td align="center"><strong>>30</strong></td>
                               <td align="center"><strong>>24</strong></td>
                               <td align="center"><strong>>18</strong></td>
                               <td align="center"><strong>>12</strong></td>
                               <td align="center"><strong>>6</strong></td>
                           </tr>

                       </table></div>
                </div>

                    @endif
                        @if(count($qanalysis)> 0 &&  $qanalysis !="")
                        
                        <?php 
						 $coqa=1;

                            $Management="";
                            $Market_share ="";
                            $Concentration_risk="";
                            $Track_record="";
                            $Compliance_record="";
                            $auditing_firm="";
			
			
			
           
           
						?>

                           <?php
                            foreach($qanalysis as $qal){

                                $Management=$qal->Management;
                                $Market_share =$qal->Market_share;
                                $Concentration_risk=$qal->Concentration_risk;
                                $Track_record=$qal->Track_record;
                                $Compliance_record=$qal->Compliance_record;
                                $auditing_firm=$qal->auditing_firm;

							 $coqa++;
                            }

						    ?>
                           

                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-12" >
                            <strong>(B)QUALITATIVE ANALYSIS </strong>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12"><table class="table table-bordered" >
                                        <tr>
                                            <th class="col-md-3">Parameters:</th>
                                            <th>AAA</th>
                                            <th>AA</th>
                                            <th>A</th>
                                            <th>BB</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Management  </td>
                                            <td align="center"><input id="m" type="radio" name="Management" @if($Management=="1") checked="checked" @endif value="1" style="width: 20px; height: 20px; float: left; margin-right: 5px" >
                                            </td>
                                            <td align="center"><input id="m" type="radio" name="Management" @if($Management=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input id="m" type="radio" @if($Management=="3") checked="checked" @endif name="Management" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input id="m" type="radio" @if($Management=="4" ) checked="checked" @endif name="Management" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" @if($Management=="5") checked="checked" @endif name="Management" value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" @if($Management=="6") checked="checked" @endif name="Management" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" @if($Management=="7") checked="checked" @endif name="Management" value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="col-md-3">Market share </td>
                                            <td align="center"><input type="radio" name="Market_share" @if($Market_share=="1") checked="checked" @endif value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share"@if($Market_share=="2") checked="checked" @endif  value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" @if($Market_share=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" @if($Market_share=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" @if($Market_share=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" @if($Market_share=="6") checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" @if($Market_share=="7") checked="checked" @endif value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Concentration risk (on supplier and buyers) </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" @if($Concentration_risk=="1") checked="checked" @endif value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" @if($Concentration_risk=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" @if($Concentration_risk=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" @if($Concentration_risk=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" @if($Concentration_risk=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" @if($Concentration_risk=="6") checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" @if($Concentration_risk=="7") checked="checked" @endif value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Track  record of promoters  </td>
                                            <td align="center"><input type="radio" name="Track_record" @if($Track_record=="1") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" @if($Track_record=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" @if($Track_record=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" @if($Track_record=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" @if($Track_record=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" @if($Track_record=="6") checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" @if($Track_record=="7") checked="checked" @endif value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"> Compliance record [No pending audit issues] insurance policy, land rent, financial update </td>
                                            <td align="center"><input type="radio" name="Compliance_record" @if($Compliance_record=="2") checked="checked" @endif value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" @if($Compliance_record=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" @if($Compliance_record=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" @if($Compliance_record=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" @if($Compliance_record=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" @if($Compliance_record=="6") checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" @if($Compliance_record=="7") checked="checked" @endif value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Type of auditing firm  </td>
                                            <td align="center"><input type="radio" name="auditing_firm" @if($auditing_firm=="1") checked="checked" @endif value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" @if($auditing_firm=="2") checked="checked" @endif value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" @if($auditing_firm=="3") checked="checked" @endif value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" @if($auditing_firm=="4") checked="checked" @endif value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" @if($auditing_firm=="5") checked="checked" @endif value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" @if($auditing_firm=="6") checked="checked" @endif value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" @if($auditing_firm=="7") checked="checked" @endif value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><strong>Weight</strong></td>
                                            <td align="center"><strong>7</strong></td>
                                            <td align="center"><strong>6</strong></td>
                                            <td align="center"><strong>5</strong></td>
                                            <td align="center"><strong>4</strong></td>
                                            <td align="center"><strong>3</strong></td>
                                            <td align="center"><strong>2</strong></td>
                                            <td align="center"><strong>1</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><strong>SCORE </strong> </td>
                                            <td align="center"><strong>>42</strong></td>
                                            <td align="center"><strong>>36</strong></td>
                                            <td align="center"><strong>>30</strong></td>
                                            <td align="center"><strong>>24</strong></td>
                                            <td align="center"><strong>>18</strong></td>
                                            <td align="center"><strong>>12</strong></td>
                                            <td align="center"><strong>>6</strong></td>
                                        </tr>
                                    </table></div>
                    </div>
                            @else
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-12" >
                                    <strong>(B)QUALITATIVE ANALYSIS </strong>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered" >
                                        <tr>
                                            <th class="col-md-3">Parameters:</th>
                                            <th>AAA</th>
                                            <th>AA</th>
                                            <th>A</th>
                                            <th>BB</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Management  </td>
                                            <td align="center"><input id="m" type="radio" name="Management" value="1" style="width: 20px; height: 20px; float: left; margin-right: 5px" >
                                            </td>
                                            <td align="center"><input id="m" type="radio" name="Management" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input id="m" type="radio" name="Management" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input id="m" type="radio" name="Management" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Management" value="5"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Management" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Management" value="7"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="col-md-3">Market share  </td>
                                            <td align="center"><input type="radio" name="Market_share" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" value="5"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Market_share" value="7"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Concentration risk (on supplier and buyers) </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" value="5"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Concentration_risk" value="7"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Track  record of promoters  </td>
                                            <td align="center"><input type="radio" name="Track_record" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" value="5"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Track_record" value="7"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"> Compliance record [No pending audit issues] insurance policy, land rent, financial update </td>
                                            <td align="center"><input type="radio" name="Compliance_record" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" value="5"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="Compliance_record" value="7"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Type of auditing firm  </td>
                                            <td align="center"><input type="radio" name="auditing_firm" value="1"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" value="2"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" value="3"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" value="4"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" value="5"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" value="6"  style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                            <td align="center"><input type="radio" name="auditing_firm" value="7"   style="width: 20px; height: 20px; float: left; margin-right: 5px">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><strong>Weight</strong></td>
                                            <td align="center"><strong>7</strong></td>
                                            <td align="center"><strong>6</strong></td>
                                            <td align="center"><strong>5</strong></td>
                                            <td align="center"><strong>4</strong></td>
                                            <td align="center"><strong>3</strong></td>
                                            <td align="center"><strong>2</strong></td>
                                            <td align="center"><strong>1</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"><strong>SCORE </strong> </td>
                                            <td align="center"><strong>>42</strong></td>
                                            <td align="center"><strong>>36</strong></td>
                                            <td align="center"><strong>>30</strong></td>
                                            <td align="center"><strong>>24</strong></td>
                                            <td align="center"><strong>>18</strong></td>
                                            <td align="center"><strong>>12</strong></td>
                                            <td align="center"><strong>>6</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @endif

            </div>

            </div>
        </div>


    </div>
</div>

<div class="row" style="margin-left: 20px; margin-bottom: 30px">
    <div class="col-md-12">
        <div class="col-md-2 pull-right">
            <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        <div class="col-md-2 pull-right">
            <input type="button" name="Reset" id="button" class="btn btn-success btn-block" value="Reset" onblur="resetAllControls();" />
        </div>

        <div class="col-md-2 pull-right">
            <button type="submit" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
            <input type="hidden" name="id" value="@if(old('id') != "") {{old('id')}} @else {{$id}} @endif"/>
            <input type="hidden" name="crp_id" value="@if(old('crp_id') != "") {{old('crp_id')}} @else {{$crid}} @endif"/>
            <input type="hidden" name="apprequest" value="@if(old('apprequest') != "") {{old('apprequest')}} @else {{$apprequest}} @endif"/>
        </div>
        <div id="output" class="col-md-6"></div>

    </div>
</div>
{!! Form::close() !!}
<script>
    //Callback handler for form submit event
    $("#ajax-form").validate({
        submitHandler: function(form) {
            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
            var postData = $('#ajax-form').serializeArray();
            var formURL = $('#ajax-form').attr("action");
            $.ajax(
                    {
                        url : formURL,
                        type: "POST",
                        data : postData,
                        success:function(data)
                        {
                            console.log(data);
                            //data: return data from server
                            $("#appcontentslist").load("<?php echo url("credit-proposal/app")."/".$crid; ?>");
                            $("#output").html(data);
                            setTimeout(function() {
                                $("#myModal").modal("hide");
                            }, 3000);
                        },
                        error: function(data)
                        {
                            console.log(data.responseJSON);
                            //in the responseJSON you get the form validation back.
                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");
                            $("#appcontentslist").load("<?php echo url("credit-proposal/app")."/".$crid; ?>");
                            $("#output").html(data);
                            setTimeout(function() {
                                $("#myModal").modal("hide");
                            }, 3000);
                        }
                    });
        }
    });

    //Function to reset all controlls
    function resetAllControls()
    {
        $('input[name=Management]').attr('checked',false);
        $('input[name=Market_share]').attr('checked',false);
        $('input[name=Concentration_risk]').attr('checked',false);
        $('input[name=Track_record]').attr('checked',false);
        $('input[name=Compliance_record]').attr('checked',false);
        $('input[name=auditing_firm]').attr('checked',false);

        $('input[name=Current_Ratio]').attr('checked',false);
        $('input[name=Debt_Service]').attr('checked',false);
        $('input[name=Dept_Equity]').attr('checked',false);
        $('input[name=Asset_Coverage]').attr('checked',false);
        $('input[name=Security_Cove]').attr('checked',false);
        $('input[name=Operation_Profit]').attr('checked',false);

        document.getElementById("submitButton").focus();
    }

    </script>