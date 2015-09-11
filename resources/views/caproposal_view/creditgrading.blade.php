<?php
$crid=$crp->id;
$apprequest =0;

$id=0;
$qanalysis="";
$qntanalysis="";
$crg="";
if( count($crp->creditRiskGrading) >0 )
{
    $apprequest=1;
    $crg=$crp->creditRiskGrading;
    $id=$crg->id;
    $qanalysis=$crg->qanalysis;
    $qntanalysis=$crg->qntanalysis;
}
$totalScoreQa=0;
$totalScoreQn=0;
$totalOverall=0;
?>
<div class="row row-bg">
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>CREDIT RISK GRADING</h4>
                </div>
                <div class="widget-content">
                    @if(count($qntanalysis)> 0 &&  $qntanalysis !="")
                    <div class="page">
                        <div class="container">


                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-12" style="text-align: center;" >
                                    <strong>CREDIT RISK GRADING </strong>
                                </div>
                            </div>

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

                                            //Define index counter for each quantitative
                                            $ind_aaa=0;
                                            $ind_aa=0;
                                            $ind_a=0;
                                            $ind_bb=0;
                                            $ind_b=0;
                                            $ind_c=0;
                                            $ind_d=0;



                                            $co=1;

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
                                                <td class="col-md-3"> Current Ratio Current Assets<br/>Liabilities  </td>
                                                <td align="center"> @if($Current_Ratio=="1") <?php $ind_aaa =$ind_aaa+1; ?> &#10004;  @endif</td>

                                                <td align="center">  @if($Current_Ratio=="2")  <?php $ind_aa =$ind_aa+1; ?>&#10004;  @endif </td>

                                                <td align="center">  @if($Current_Ratio=="3")  <?php $ind_a =$ind_a+1; ?> &#10004;  @endif </td>

                                                <td align="center">  @if($Current_Ratio=="4") <?php $ind_bb =$ind_bb+1; ?> &#10004;  @endif  </td>

                                                <td align="center">  @if($Current_Ratio=="5")  <?php $ind_b =$ind_b+1; ?> &#10004;  @endif  </td>

                                                <td align="center">  @if($Current_Ratio=="6") <?php $ind_c =$ind_c+1; ?>  &#10004;  @endif </td>

                                                <td align="center">  @if($Current_Ratio=="7")  <?php $ind_d =$ind_d+1; ?>  &#10004;  @endif </td>

                                            </tr>

                                            <tr>
                                                <td class="col-md-3">Debt Service CoverageRation (DSCR)<br/> Debt repayment obligation/<br/> EBITDAY (gross profit) </td>
                                                <td align="center">  @if($Debt_Service=="1") <?php $ind_aaa =$ind_aaa+1; ?> &#10004;  @endif
                                                </td>

                                                <td align="center"> @if($Debt_Service=="2") <?php $ind_aa =$ind_aa+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Debt_Service=="3") <?php $ind_a =$ind_a+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Debt_Service=="4") <?php $ind_bb =$ind_bb+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Debt_Service=="5")  <?php $ind_b =$ind_b+1; ?>&#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Debt_Service=="6") <?php $ind_c =$ind_c+1; ?> &#10004;  @endif

                                                <td align="center"> @if($Debt_Service=="7") <?php $ind_d =$ind_d+1; ?>  &#10004;  @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-3">Dept -Equity long term Debt /<br/>Shareholder funds  </td>
                                                <td align="center"> @if($Dept_Equity=="1") <?php $ind_aaa =$ind_aaa+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Dept_Equity=="2") <?php $ind_aa =$ind_aa+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Dept_Equity=="3") <?php $ind_a =$ind_a+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Dept_Equity=="4") <?php $ind_bb =$ind_bb+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Dept_Equity=="5") <?php $ind_b =$ind_b+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Dept_Equity=="6")  <?php $ind_c =$ind_c+1; ?>&#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Dept_Equity=="7") <?php $ind_d =$ind_d+1; ?>  &#10004;  @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-3">Asset Coverage Fixed Assets<br/> /Dept  </td>
                                                <td align="center"> @if($Asset_Coverage=="1") <?php $ind_aaa =$ind_aaa+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Asset_Coverage=="2") <?php $ind_aa =$ind_aa+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Asset_Coverage=="3") <?php $ind_a =$ind_a+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Asset_Coverage=="4") <?php $ind_bb =$ind_bb+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Asset_Coverage=="5") <?php $ind_b =$ind_b+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Asset_Coverage=="6") <?php $ind_c =$ind_c+1; ?>  &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Asset_Coverage=="7")  <?php $ind_d =$ind_d+1; ?>  &#10004;  @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-3">Security Cover FSV / Loan under the <br/>security </td>
                                                <td align="center"> @if($Security_Cove=="1") <?php $ind_aaa =$ind_aaa+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Security_Cove=="2") <?php $ind_aa =$ind_aa+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Security_Cove=="3") <?php $ind_a =$ind_a+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Security_Cove=="4")  <?php $ind_bb =$ind_bb+1; ?>&#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Security_Cove=="5") <?php $ind_b =$ind_b+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Security_Cove=="6" )  <?php $ind_c =$ind_c+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Security_Cove=="7") <?php $ind_d =$ind_d+1; ?>  &#10004;  @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="col-md-3">Operation Profit  </td>
                                                <td align="center"> @if($Operation_Profit=="1")   <?php $ind_aaa =$ind_aaa+1; ?>&#10004;  @endif
                                                </td>
                                                <td align="center"><strong>@if($Operation_Profit=="2") <?php $ind_aa =$ind_aa+1; ?> &#10004;  @endif
                                                    </strong>
                                                </td>
                                                <td align="center"> @if($Operation_Profit=="3") <?php $ind_a =$ind_a+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Operation_Profit=="4")  <?php $ind_bb =$ind_bb+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Operation_Profit=="5") <?php $ind_b =$ind_b+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Operation_Profit=="6")  <?php $ind_c =$ind_c+1; ?> &#10004;  @endif
                                                </td>
                                                <td align="center"> @if($Operation_Profit=="7")  <?php $ind_d =$ind_d+1; ?> &#10004;  @endif
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
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-12" >
                                        Credit Files will be rated on the basis of the aggregate of the scores as above
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 10px;">
                                    <div class="col-md-12" >
                                        <?php
                                        $totalScoreQa=0;
                                        $totalScoreQn=($ind_aaa * 7) +($ind_aa * 6) +($ind_a*5)+ ($ind_bb*4)+($ind_b*3) + ($ind_c*2)+($ind_d*1);
                                        $totalOverall=0;

                                        ?>
                                        <strong>Total score: {{ $totalScoreQn}} (Rating) </strong>
                                    </div>
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

                                //Define index counter for each qualitative
                                $ind_qaaa=0;
                                $ind_qaa=0;
                                $ind_qa=0;
                                $ind_qbb=0;
                                $ind_qb=0;
                                $ind_qc=0;
                                $ind_qd=0;



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
                                <div class="row">
                                    <div class="col-md-12">


                                        <p><strong><u>QUANTITATIVE  RISK RATING RATIONALE</u></strong></p>
                                        <p>RISK  RATING<strong> - AAA- Excellent Risk</strong>, it is  desirable to increase exposure.<strong></strong></p>
                                        <ul>
                                            <li>Well  experienced and qualified management with excellent track record.</li>
                                            <li>The  company has at least 20% of the market</li>
                                            <li>Company  is a market leader</li>
                                            <li>The  company has well diversified suppliers and buyers. No supplier accounts over  20% of the key raw materials and no buyer takes over 20% of the finished goods  of the company.</li>
                                            <li>Exemplary  compliance record with no pending audit related issues.</li>
                                            <li>The company&rsquo;s auditing firm is among of the  international auditing firms, i.e. PWC, Deloitte &amp; Touché, KPMG, and Ernst  &amp; Young &amp; PKF.</li>
                                        </ul>
                                        <p>RISK  RATING<strong> - AA- Very Good Risk</strong>, the  bank may consider increasing exposure.<strong></strong></p>
                                        <ul>
                                            <li>Experienced  and qualified management with excellent track record.</li>
                                            <li>The  company has at least 10% -20% of the market</li>
                                            <li>Company  is one of the leading players in the market</li>
                                            <li>The  company has diversified suppliers and buyers with some level of concentration  on suppliers and buyers</li>
                                            <li>Good  Compliance record with no pending audit related issues. </li>
                                            <li>The  company&rsquo;s auditing firm is among local but well known auditing firms such as  Sreekumar &amp; Co, Brahmbhatt &amp;  Co, and Grant Thornton.</li>
                                        </ul>
                                        <p>&nbsp;</p>
                                        <p>RISK  RATING<strong> - A- Good Risk</strong>, the bank must  retain the relationship at the existing level and consider increasing exposure  depending upon improvement in track record.<strong></strong></p>
                                        <ul>
                                            <li>Experienced  and qualified management with track record.</li>
                                            <li>The  company has a market share of less than 10%.</li>
                                            <li>Company  is dependent on some few suppliers for its goods and likewise there is  dependent on few buyers for its finished goods.</li>
                                            <li>God  compliance record with no Outstanding audit issues.</li>
                                            <li>Financial  statements being audited by registered audit firms with acceptable track record.</li>
                                        </ul>
                                        <p>RISK  RATING<strong> - BB- Good Risk</strong>, the bank  must retain the relationship at the existing level and any opportunity or  request for enhancement must be closely examined.<strong></strong></p>
                                        <ul>
                                            <li>Qualified  management with good track record.</li>
                                            <li>The  company has small market share of less than 10%. </li>
                                            <li>The  company shows dependency on relatively few suppliers and buyers.</li>
                                            <li>Audited  books are prepared by a firm with no track in the market. </li>
                                        </ul>
                                        <p>RISK  RATING<strong> - B- Satisfactory Risk</strong>, the  bank may retain the relationship at the existing level and any  opportunity or request for enhancement must be closely examined.<strong></strong></p>
                                        <ul>
                                            <li>Qualified  management with satisfactory track record.</li>
                                            <li>The  company has negligible market share</li>
                                            <li>The  company is dependent on one or few suppliers and buyers </li>
                                            <li>Audited  books are prepared by a firm with no track in the market.  </li>
                                        </ul>
                                        <p>RISK  RATING<strong> - C- Watch Risk</strong>, No  additional exposure and needs close monitoring. <strong></strong></p>
                                        <ul>
                                            <li>Management  and ownership is mixed up.</li>
                                            <li>The  company may be susceptible to industry cycles and therefore may not sustain  major or prolonged setbacks.</li>
                                            <li>Security  cover may be adequate but liquidity may be difficult.</li>
                                        </ul>
                                        <p>RISK  RATING<strong> - D- Not acceptable</strong>, if a  relationship, disengagement monitoring.</p>
                                        <ul>
                                            <li>Management  and ownership is mixed up and management is loosing track of the company&rsquo;s  performance.</li>
                                            <li>The  company may not sustain any major down turn in the economic cycle.</li>
                                        </ul>
                                        <p>Security,  coverage, quality and liquidity are poor or have deteriorated over the past  mont</p>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="page">
                        <div class="container">
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
                                            <td align="center">@if($Management=="1") <?php $ind_qaaa =$ind_qaaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Management=="2") <?php $ind_qaa =$ind_qaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Management=="3") <?php $ind_qa =$ind_qa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Management=="4" ) <?php $ind_qbb =$ind_qbb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Management=="5") <?php $ind_qb =$ind_qb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Management=="6") <?php $ind_qc =$ind_qc+1; ?>  &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Management=="7")  <?php $ind_qd =$ind_qd+1; ?>  &#10004;  @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="col-md-3">Market share  </td>
                                            <td align="center"> @if($Market_share=="1") <?php $ind_qaaa =$ind_qaaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center">@if($Market_share=="2")  <?php $ind_qaa =$ind_qaa+1; ?>&#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Market_share=="3") <?php $ind_qa =$ind_qa+1; ?>  &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Market_share=="4") <?php $ind_qbb =$ind_qbb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Market_share=="5") <?php $ind_qb =$ind_qb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Market_share=="6") <?php $ind_qc =$ind_qc+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Market_share=="7")  <?php $ind_qd =$ind_qd+1; ?> &#10004;  @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Concentration risk (on supplier and buyers) </td>
                                            <td align="center"> @if($Concentration_risk=="1") <?php $ind_qaaa =$ind_qaaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Concentration_risk=="2") <?php $ind_qaa =$ind_qaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Concentration_risk=="3")  <?php $ind_qa =$ind_qa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Concentration_risk=="4")  <?php $ind_qbb =$ind_qbb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Concentration_risk=="5") <?php $ind_qb =$ind_qb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Concentration_risk=="6") <?php $ind_qc =$ind_qc+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Concentration_risk=="7") <?php $ind_qd =$ind_qd+1; ?> &#10004;  @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Track  record of promoters  </td>
                                            <td align="center"> @if($Track_record=="1") <?php $ind_qaaa =$ind_qaaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Track_record=="2")  <?php $ind_qaa =$ind_qaa+1; ?>&#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Track_record=="3") <?php $ind_qa =$ind_qa+1; ?>  &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Track_record=="4")  <?php $ind_qbb =$ind_qbb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Track_record=="5")  <?php $ind_qb =$ind_qb+1; ?>&#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Track_record=="6")  <?php $ind_qc =$ind_qc+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Track_record=="7")  <?php $ind_qd =$ind_qd+1; ?> &#10004;  @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3"> Compliance record [No pending audit issues]<br/> insurance policy, land rent, financial update </td>
                                            <td align="center"> @if($Compliance_record=="1") <?php $ind_qaaa =$ind_qaaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Compliance_record=="2")  <?php $ind_qaa =$ind_qaa+1; ?>&#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Compliance_record=="3") <?php $ind_qa =$ind_qa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Compliance_record=="4") <?php $ind_qbb =$ind_qbb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Compliance_record=="5")  <?php $ind_qb =$ind_qb+1; ?>&#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Compliance_record=="6")  <?php $ind_qc =$ind_qc+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($Compliance_record=="7")  <?php $ind_qd =$ind_qd+1; ?> &#10004;  @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">Type of auditing firm   </td>
                                            <td align="center"> @if($auditing_firm=="1") <?php $ind_qaaa =$ind_qaaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($auditing_firm=="2") <?php $ind_qaa =$ind_qaa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($auditing_firm=="3") <?php $ind_qa =$ind_qa+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($auditing_firm=="4") <?php $ind_qbb =$ind_qbb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($auditing_firm=="5") <?php $ind_qb =$ind_qb+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($auditing_firm=="6")  <?php $ind_qc =$ind_qc+1; ?> &#10004;  @endif
                                            </td>
                                            <td align="center"> @if($auditing_firm=="7")  <?php $ind_qd =$ind_qd+1; ?> &#10004;  @endif
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
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-12" >
                                    Credit Files will be rated on the basis of the aggregate of the scores as above
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-12" >
                                    <?php  $totalScoreQa=($ind_qaaa * 7) +($ind_qaa * 6) +($ind_qa*5)+ ($ind_qbb*4)+($ind_qb*3) + ($ind_qc*2)+($ind_qd*1);?>
                                    <strong>Total score:{{ $totalScoreQa}} (Rating) </strong>
                                </div>
                            </div>


                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-6" >
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Summary</th>
                                            <th>Score</th>
                                            <th>Max</th>
                                            <th>Rating</th>
                                        </tr>
                                        <tr>
                                            <td>Quantitative</td>
                                            <td>{{$totalScoreQn}}</td>
                                            <td><?php
                                                $avr=$totalScoreQn;
                                                if($avr > 42)
                                                {
                                                    echo "49";
                                                }
                                                elseif($avr > 36)
                                                {
                                                    echo "42";
                                                }
                                                elseif($avr > 30)
                                                {
                                                    echo "36";
                                                }
                                                elseif($avr > 24)
                                                {
                                                    echo "30";
                                                }
                                                elseif($avr > 18)
                                                {
                                                    echo "24";
                                                }
                                                elseif($avr > 12)
                                                {
                                                    echo "18";
                                                }
                                                elseif($avr >= 6)
                                                {
                                                    echo "12";
                                                }


                                                ?></td>
                                            <td>
                                                <?php
                                                if($totalScoreQn > 42)
                                                {
                                                    echo "AAA";
                                                }
                                                elseif($totalScoreQn > 36)
                                                {
                                                    echo "AA";
                                                }
                                                elseif($totalScoreQn > 30)
                                                {
                                                    echo "A";
                                                }
                                                elseif($totalScoreQn > 24)
                                                {
                                                    echo "BB";
                                                }
                                                elseif($totalScoreQn > 18)
                                                {
                                                    echo "B";
                                                }
                                                elseif($totalScoreQn > 12)
                                                {
                                                    echo "C";
                                                }
                                                elseif($totalScoreQn >= 6)
                                                {
                                                    echo "D";
                                                }


                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Qualitative</td>
                                            <td>{{$totalScoreQa}}</td>
                                            <td><?php
                                                $avr=$totalScoreQa;
                                                if($avr > 42)
                                                {
                                                    echo "49";
                                                }
                                                elseif($avr > 36)
                                                {
                                                    echo "42";
                                                }
                                                elseif($avr > 30)
                                                {
                                                    echo "36";
                                                }
                                                elseif($avr > 24)
                                                {
                                                    echo "30";
                                                }
                                                elseif($avr > 18)
                                                {
                                                    echo "24";
                                                }
                                                elseif($avr > 12)
                                                {
                                                    echo "18";
                                                }
                                                elseif($avr >= 6)
                                                {
                                                    echo "12";
                                                }


                                                ?></td>
                                            <td><?php
                                                if($totalScoreQa > 42)
                                                {
                                                    echo "AAA";
                                                }
                                                elseif($totalScoreQa > 36)
                                                {
                                                    echo "AA";
                                                }
                                                elseif($totalScoreQa > 30)
                                                {
                                                    echo "A";
                                                }
                                                elseif($totalScoreQa > 24)
                                                {
                                                    echo "BB";
                                                }
                                                elseif($totalScoreQa > 18)
                                                {
                                                    echo "B";
                                                }
                                                elseif($totalScoreQa > 12)
                                                {
                                                    echo "C";
                                                }
                                                elseif($totalScoreQa >= 6)
                                                {
                                                    echo "D";
                                                }


                                                ?></td>
                                        </tr>
                                        <tr>
                                            <td>Overall</td>
                                            <td>{{ceil(($totalScoreQn+$totalScoreQa) / 2)}}</td>
                                            <td><?php
                                                $avr=ceil(($totalScoreQn+$totalScoreQa) / 2);
                                                if($avr > 42)
                                                {
                                                    echo "49";
                                                }
                                                elseif($avr > 36)
                                                {
                                                    echo "42";
                                                }
                                                elseif($avr > 30)
                                                {
                                                    echo "36";
                                                }
                                                elseif($avr > 24)
                                                {
                                                    echo "30";
                                                }
                                                elseif($avr > 18)
                                                {
                                                    echo "24";
                                                }
                                                elseif($avr > 12)
                                                {
                                                    echo "18";
                                                }
                                                elseif($avr >= 6)
                                                {
                                                    echo "12";
                                                }


                                                ?></td>
                                            <td><?php
                                                $avr=ceil(($totalScoreQn+$totalScoreQa) / 2);
                                                if($avr > 42)
                                                {
                                                    echo "AAA";
                                                }
                                                elseif($avr > 36)
                                                {
                                                    echo "AA";
                                                }
                                                elseif($avr > 30)
                                                {
                                                    echo "A";
                                                }
                                                elseif($avr > 24)
                                                {
                                                    echo "BB";
                                                }
                                                elseif($avr > 18)
                                                {
                                                    echo "B";
                                                }
                                                elseif($avr > 12)
                                                {
                                                    echo "C";
                                                }
                                                elseif($avr >= 6)
                                                {
                                                    echo "D";
                                                }


                                                ?></td>
                                        </tr>
                                    </table>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">


                                    <p><strong><u>QUALITATIVE  RISK RATING RATIONALE</u></strong></p>
                                    <p>RISK  RATING<strong> - AAA- Excellent Risk</strong>, it is  desirable to increase exposure.<strong></strong></p>
                                    <ul>
                                        <li>Well  experienced and qualified management with excellent track record.</li>
                                        <li>The  company has at least 20% of the market</li>
                                        <li>Company  is a market leader</li>
                                        <li>The  company has well diversified suppliers and buyers. No supplier accounts over  20% of the key raw materials and no buyer takes over 20% of the finished goods  of the company.</li>
                                        <li>Exemplary  compliance record with no pending audit related issues.</li>
                                        <li>The company&rsquo;s auditing firm is among of the  international auditing firms, i.e. PWC, Deloitte &amp; Touché, KPMG, and Ernst  &amp; Young &amp; PKF.</li>
                                    </ul>
                                    <p>RISK  RATING<strong> - AA- Very Good Risk</strong>, the  bank may consider increasing exposure.<strong></strong></p>
                                    <ul>
                                        <li>Experienced  and qualified management with excellent track record.</li>
                                        <li>The  company has at least 10% -20% of the market</li>
                                        <li>Company  is one of the leading players in the market</li>
                                        <li>The  company has diversified suppliers and buyers with some level of concentration  on suppliers and buyers</li>
                                        <li>Good  Compliance record with no pending audit related issues. </li>
                                        <li>The  company&rsquo;s auditing firm is among local but well known auditing firms such as  Sreekumar &amp; Co, Brahmbhatt &amp;  Co, and Grant Thornton.</li>
                                    </ul>
                                    <p>&nbsp;</p>
                                    <p>RISK  RATING<strong> - A- Good Risk</strong>, the bank must  retain the relationship at the existing level and consider increasing exposure  depending upon improvement in track record.<strong></strong></p>
                                    <ul>
                                        <li>Experienced  and qualified management with track record.</li>
                                        <li>The  company has a market share of less than 10%.</li>
                                        <li>Company  is dependent on some few suppliers for its goods and likewise there is  dependent on few buyers for its finished goods.</li>
                                        <li>God  compliance record with no Outstanding audit issues.</li>
                                        <li>Financial  statements being audited by registered audit firms with acceptable track record.</li>
                                    </ul>
                                    <p>RISK  RATING<strong> - BB- Good Risk</strong>, the bank  must retain the relationship at the existing level and any opportunity or  request for enhancement must be closely examined.<strong></strong></p>
                                    <ul>
                                        <li>Qualified  management with good track record.</li>
                                        <li>The  company has small market share of less than 10%. </li>
                                        <li>The  company shows dependency on relatively few suppliers and buyers.</li>
                                        <li>Audited  books are prepared by a firm with no track in the market.</li>
                                    </ul>
                                    <p> RISK  RATING<strong> - B- Satisfactory Risk</strong>, the  bank may retain the relationship at the existing level and any  opportunity or request for enhancement must be closely examined.<strong></strong></p>
                                    <ul>
                                        <li>Qualified  management with satisfactory track record.</li>
                                        <li>The  company has negligible market share</li>
                                        <li>The  company is dependent on one or few suppliers and buyers </li>
                                        <li>Audited  books are prepared by a firm with no track in the market.</li>
                                    </ul>
                                    <p>RISK  RATING<strong> - C- Watch Risk</strong>, No  additional exposure and needs close monitoring. <strong></strong></p>
                                    <ul>
                                        <li>Management  and ownership is mixed up.</li>
                                        <li>The  company may be susceptible to industry cycles and therefore may not sustain  major or prolonged setbacks.</li>
                                        <li>Security  cover may be adequate but liquidity may be difficult.</li>
                                    </ul>
                                    <p>RISK  RATING<strong> - D- Not acceptable</strong>, if a  relationship, disengagement monitoring.</p>
                                    <ul>
                                        <li>Management  and ownership is mixed up and management is loosing track of the company&rsquo;s  performance.</li>
                                        <li>The  company may not sustain any major down turn in the economic cycle.</li>
                                    </ul>
                                    <p>Security,  coverage, quality and liquidity are poor or have deteriorated over the past  mont</p>
                                </div>
                            </div>
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
            <a href="#" data-dismiss="modal"  class="btn btn-success btn-block"> <i class="icon-remove"></i>  Ok</a>
        </div>
    </div>
</div>
