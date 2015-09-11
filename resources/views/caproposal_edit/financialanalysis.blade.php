
{!!HTML::script("assets/js/tinymce/tinymce.min.js")!!}
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist autolink lists   charmap   anchor",
            "insertdatetime  contextmenu paste"
        ],
        toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent "
    });
</script>

<?php
    $crid=$crp->id;
    $apprequest =0;
    $id=0;
    $fin="";
    $sale="";
    $profitability="";
    $gearing="";
    $dscr="";
    $creditors ="";
    $debtor="";
    $liquidity="";
    $worth="";



if( count($crp->financialAnalysis) !=0 )
{
    $fna=$crp->financialAnalysis;

    $id=$fna->id;
    $apprequest=1;

    //Financial analysis components
    $sale=$fna->sale;
    $profitability=$fna->profitability;
    $gearing=$fna->gearing;
    $dscr=$fna->dscr;
    $creditors =$fna->creditors;
    $debtor=$fna->debtor;
    $liquidity=$fna->liquidity;
    $worth=$fna->worth;
}
$rules = ['d_date1'=>'date','org_hq'=>'alpha_dash','sales_distributions'=>'alpha_dash','credit_terms'=>'alpha_dash','product_traded'=>'alpha_dash'];
?>
{!! Form::open(array('url' => 'financial-analysis', 'class' => 'form-horizontal row-border','id'=>'ajax-form'),$rules) !!}
@if( $apprequest ==1)

    <div class="row row-bg">
    <div class="row" >
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>FINANCIAL ANALYSIS</h4>
                </div>
                <div class="widget-content">

                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                            <strong>1. Sales</strong>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-12">
                              <table class="table ">
                                  @if($sale !=null || $sale !="" )
                                  <tr>
                                      <th rowspan="2">Year</th>
                                      <th><input type="text"  data-rule-date="true" data-msg-date="The Field is not a valid date."  name="d_date1"    class="form-control"  value="@if($sale->date_1 !=""){{date("d.m.Y",strtotime($sale->date_1))}}@endif"/></th>
                                      <th><input type="text"  data-rule-date="true" data-msg-date="The Field is not a valid date." name="d_date2"    class="form-control"  value="@if($sale->date_2 !=""){{date("d.m.Y",strtotime($sale->date_2))}}@endif"/></th>
                                      <th><input type="text"  data-rule-date="true" data-msg-date="The Field is not a valid date." name="d_date3"    class="form-control"  value="@if($sale->date_3 !=""){{date("d.m.Y",strtotime($sale->date_3))}}@endif"/></th>
                                  </tr>
                                  @else
                                      <tr>
                                          <th rowspan="2">Year</th>
                                          <th><input type="text" name="d_date1"    class="form-control"  /></th>
                                          <th><input type="text" name="d_date2"    class="form-control"  /></th>
                                          <th><input type="text" name="d_date3"    class="form-control"  /></th>
                                      </tr>
                                      @endif
                                  <tr>
                                      <th>Audited</th>
                                      <th>Audited</th>
                                      <th>Audited</th>
                                  </tr>
                                              @if(count($sale->detail) > 0)
                                                  @foreach($sale->detail as $d)
                                              <tr>
                                                  <th><input type="hidden"  name="d1[]" class="form-control" value="{{$d->data_1}}" />{{$d->data_1}}</th>
                                                  <td><input type="text"  name="d2[]" class="form-control" value="{{$d->data_2}}"/></td>
                                                  <td><input type="text"  name="d3[]" class="form-control" value="{{$d->data_3}}"/></td>
                                                  <td><input type="text"  name="d4[]" class="form-control" value="{{$d->data_4}}"/></td>

                                              </tr>
                                                  @endforeach
                                                  @else
                                                  <tr>
                                                      <th><input type="hidden"  name="d1[]" class="form-control" value="Turnover" />Turnover</th>
                                                      <td><input type="text"  name="d2[]" class="form-control"/></td>
                                                      <td><input type="text"  name="d3[]" class="form-control"/></td>
                                                      <td><input type="text"  name="d4[]" class="form-control"/></td>

                                                  </tr>
                                                  <tr>
                                                      <th><input type="hidden"  name="d1[]" class="form-control" value="% Annual growth" />% Annual growth</th>
                                                      <td><input type="text"  name="d2[]" class="form-control"/></td>
                                                      <td><input type="text"  name="d3[]" class="form-control"/></td>
                                                      <td><input type="text"  name="d4[]" class="form-control"/></td>

                                                  </tr>
                                              @endif

                                  <tr>
                                      <td>Comment with reason, only if
                                      <ol>
                                          <li>The growth rate is errastic.</li>
                                          <li>Any sharp fluctuation in any year.</li>
                                          <li>Any exception performance.</li>
                                      </ol></td>
                                      <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."    name="d_comment" rows="3">@if($sale !="" && $sale != null){{$sale->comments}} @endif</textarea></td>
                                  </tr>
                              </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                                <strong>2. Profitability</strong>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-12">
                                <table class="table ">
                                    @if($profitability != null && $profitability != "")
                                    <tr>
                                        <th rowspan="2">Year</th>
                                        <th><input type="text" name="pr_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control" value="@if($profitability->date_1 !=""){{date("d.m.Y",strtotime($profitability->date_1))}}@endif"/></th>
                                        <th><input type="text" name="pr_date2"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control " value="@if($profitability->date_2 !=""){{date("d.m.Y",strtotime($profitability->date_2))}}@endif"/></th>
                                        <th><input type="text" name="pr_date3"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control " value="@if($profitability->date_3 !=""){{date("d.m.Y",strtotime($profitability->date_3))}}@endif"/></th>
                                    </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="pr_date1"    class="form-control" /></th>
                                            <th><input type="text" name="pr_date2"    class="form-control " /></th>
                                            <th><input type="text" name="pr_date3"    class="form-control " /></th>
                                        </tr>
                                        @endif
                                    <tr>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <table class="table" id="profitability">
                                                @if(count($profitability->detail) > 0)
                                                    <?php $cprof=1; ?>
                                                    @foreach($profitability->detail as $d)
                                                <tr>
                                                <td><input type="text"  name="pr1[]" class="form-control" value="{{$d->data_1}}"/></td>
                                                <td><input type="text"  name="pr2[]" class="form-control" value="{{$d->data_2}}"/></td>
                                                <td><input type="text"  name="pr3[]" class="form-control" value="{{$d->data_3}}"/></td>
                                                <td><input type="text"  name="pr4[]" class="form-control" value="{{$d->data_4}}"/></td>
                                                    <td>@if($cprof ==1)<input type="button"class="btn btn-primary" value="Add Row" onclick="addRowProfitability();" />
                                                        @else  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a> @endif </td>
                                                </tr>
                                                            <?php $cprof++; ?>
                                                    @endforeach

                                                @else
                                                <tr>
                                                    <td><input type="text"  name="pr1[]" class="form-control"/></td>
                                                    <td><input type="text"  name="pr2[]" class="form-control"/></td>
                                                    <td><input type="text"  name="pr3[]" class="form-control"/></td>
                                                    <td><input type="text"  name="pr4[]" class="form-control"/></td>
                                                    <td><input type="button"class="btn btn-primary" value="Add Row" onclick="addRowProfitability();" /> </td>
                                                </tr>
                                                @endif
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Comment with reason, only if
                                            <ol>
                                                <li>The growth rate is errastic.</li>
                                                <li>Any sharp fluctuation in any year.</li>
                                                <li>Any exception performance.</li>
                                            </ol></td>
                                        <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="pr_comment" rows="4">@if($profitability !=null & $profitability != "" ){{$profitability->comments}} @endif</textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                                <strong>3. Gearing</strong>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-12">
                                <table class="table ">
                                    @if($gearing != "" && $gearing != null)
                                    <tr>
                                        <th rowspan="2">Year</th>
                                        <th><input type="text" name="g_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control" value="@if($gearing->date_1 !=""){{date("d.m.Y",strtotime($gearing->date_1))}}@endif"/></th>
                                        <th><input type="text" name="g_date2"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control " value="@if($gearing->date_2 !=""){{date("d.m.Y",strtotime($gearing->date_2))}}@endif"/></th>
                                        <th><input type="text" name="g_date3"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control " value="@if($gearing->date_3 !=""){{date("d.m.Y",strtotime($gearing->date_3))}}@endif"/></th>
                                    </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="g_date1"    class="form-control" /></th>
                                            <th><input type="text" name="g_date2"    class="form-control " /></th>
                                            <th><input type="text" name="g_date3"    class="form-control " /></th>
                                        </tr>
                                        @endif
                                    <tr>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                    </tr>

                                                @if(count($gearing->detail) > 0)
                                                    @foreach($gearing->detail as $d)
                                                <tr>
                                                    <th><input type="hidden"  name="ge1[]" class="form-control" value="{{$d->data_1}}"/>{{$d->data_1}}</th>
                                                    <td><input type="text"  name="ge2[]" class="form-control" value="{{$d->data_2}}"/></td>
                                                    <td><input type="text"  name="ge3[]" class="form-control" value="{{$d->data_3}}"/></td>
                                                    <td><input type="text"  name="ge4[]" class="form-control" value="{{$d->data_4}}"/></td>

                                                </tr>
                                                    @endforeach
                                             @else

                                                    <tr>
                                                        <th><input type="hidden"  name="ge1[]" class="form-control" value="Debit Equity"/>Debit Equity</th>
                                                        <td><input type="text"  name="ge2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ge3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ge4[]" class="form-control"/></td>

                                                    </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="ge1[]" class="form-control" value="Leverage"/>Leverage</th>
                                                        <td><input type="text"  name="ge2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ge3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ge4[]" class="form-control"/></td>

                                                    </tr>
                                        @endif

                                    <tr>
                                        <td>Comment with reason, only if
                                            <ol>
                                                <li>The ratio is deteriorating and </li>
                                                <li>If convenants should be recommended to improve the position.</li>

                                            </ol></td>
                                        <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="g_comment" rows="4">@if($gearing !="" && $gearing !=null){{$gearing->comments}} @endif</textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                                <strong>4. DSCR </strong>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-12">
                                <table class="table ">
                                    @if($dscr !="" && $dscr != null)
                                    <tr>
                                        <th rowspan="3">Year</th>
                                        <th><input type="text" name="dscr_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control" value="@if($dscr->date_1 !=""){{date("d.m.Y",strtotime($dscr->date_1))}}@endif" /></th>
                                        <th><input type="text" name="dscr_date2"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control " value="@if($dscr->date_2 !=""){{date("d.m.Y",strtotime($dscr->date_2))}}@endif" /></th>
                                        <th><input type="text" name="dscr_dat3"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control " value="@if($dscr->date_3 !=""){{date("d.m.Y",strtotime($dscr->date_3))}}@endif"/></th>
                                    </tr>
                                    @else
                                        <tr>
                                            <th rowspan="3">Year</th>
                                            <th><input type="text" name="dscr_date1"    class="form-control"  /></th>
                                            <th><input type="text" name="dscr_date2"    class="form-control "  /></th>
                                            <th><input type="text" name="dscr_dat3"    class="form-control " /></th>
                                        </tr>
                                        @endif
                                    <tr>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                    </tr>
                                        @if(count($dscr->detail) > 0)
                                            @foreach($dscr->detail as $d)
                                                <tr>
                                                   <input type="hidden"  name="DSCR1[]" class="form-control" value="{{$d->data_1}}"/>
                                                    <td><input type="text"  name="DSCR2[]" class="form-control" value="{{$d->data_2}}"/></td>
                                                    <td><input type="text"  name="DSCR3[]" class="form-control" value="{{$d->data_3}}"/></td>
                                                    <td><input type="text"  name="DSCR4[]" class="form-control" value="{{$d->data_4}}"/></td>

                                                </tr>

                                            @endforeach

                                        @else
                                            <tr> <input type="hidden"  name="DSCR1[]" class="form-control" value=""/>
                                                <td><input type="text"  name="DSCR2[]" class="form-control" value=""/></td>
                                                <td><input type="text"  name="DSCR3[]" class="form-control" value=""/></td>
                                                <td><input type="text"  name="DSCR4[]" class="form-control" value=""/></td>
                                            </tr>

                                        @endif
                                    <tr>
                                        <td>Is it adequate to cover fresh borrowings</td>
                                        <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="dscr_comment" rows="4">@if($dscr != "" && $dscr !=null){{$dscr->comments}} @endif</textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                                <strong>5.Creditors</strong>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-12">
                                <table class="table ">
                                    @if($creditors != null && $creditors !="")
                                    <tr>
                                        <th rowspan="2">Year</th>
                                        <th><input type="text" name="ce_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control" value="@if($creditors->date_1 !=""){{date("d.m.Y",strtotime($creditors->date_1))}}@endif"  /></th>
                                        <th><input type="text" name="ce_date2"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control " value="@if($creditors->date_2 !=""){{date("d.m.Y",strtotime($creditors->date_2))}}@endif"  /></th>
                                        <th><input type="text" name="ce_date3"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "value="@if($creditors->date_3 !=""){{date("d.m.Y",strtotime($creditors->date_3))}}@endif"  /></th>
                                    </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="ce_date1"    class="form-control"  /></th>
                                            <th><input type="text" name="ce_date2"    class="form-control "   /></th>
                                            <th><input type="text" name="ce_date3"    class="form-control "  /></th>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                    </tr>

                                                @if(count($creditors->detail) > 0)
                                                    @foreach($creditors->detail as $d)
                                                <tr>
                                                    <th><input type="hidden"  name="ce1[]" class="form-control" value="{{$d->data_1}}"/>{{$d->data_1}}</th>
                                                    <td><input type="text"  name="ce2[]" class="form-control" value="{{$d->data_2}}"/></td>
                                                    <td><input type="text"  name="ce3[]" class="form-control" value="{{$d->data_3}}"/></td>
                                                    <td><input type="text"  name="ce4[]" class="form-control" value="{{$d->data_4}}"/></td>

                                                </tr>
                                                    @endforeach
                                               @else
                                                <tr>
                                                    <th><input type="hidden"  name="ce1[]" class="form-control" value="Creditor Amount">Creditor Amount</th>
                                                    <td><input type="text"  name="ce2[]" class="form-control"/></td>
                                                    <td><input type="text"  name="ce3[]" class="form-control"/></td>
                                                    <td><input type="text"  name="ce4[]" class="form-control"/></td>

                                                </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="ce1[]" class="form-control" value="Creditor Days"/>Creditor Days</th>
                                                        <td><input type="text"  name="ce2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ce3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ce4[]" class="form-control"/></td>
                                                    </tr>
                                                @endif

                                    <tr>
                                        <td>Comment with reason, only if
                                            <ol>
                                                <li>the ratio is deteriorating,</li>
                                                <li>If sharp variance, do an age analysis</li>

                                            </ol></td>
                                        <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."    name="ce_comment" rows="4">@if($creditors !="" && $creditors != null){{$creditors->comments}} @endif</textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                                <strong>6.Debtors</strong>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-12">
                                <table class="table ">
                                    @if($debtor !="" && $debtor !=null)
                                    <tr>
                                        <th rowspan="2">Year</th>
                                        <th><input type="text" name="de_date1"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control" value="@if($debtor->date_1 !=""){{date("d.m.Y",strtotime($debtor->date_1))}}@endif" /></th>
                                        <th><input type="text" name="de_date2"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control " value="@if($debtor->date_2 !=""){{date("d.m.Y",strtotime($debtor->date_2))}}@endif" /></th>
                                        <th><input type="text" name="de_date3"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control " value="@if($debtor->date_3 !=""){{date("d.m.Y",strtotime($debtor->date_3))}}@endif" /></th>
                                    </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="de_date1"    class="form-control"  /></th>
                                            <th><input type="text" name="de_date2"    class="form-control "  /></th>
                                            <th><input type="text" name="de_date3"    class="form-control "  /></th>
                                        </tr>
                                        @endif
                                    <tr>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                    </tr>

                                                @if(count($debtor->detail) > 0)
                                                    @foreach($debtor->detail as $d)
                                                <tr>
                                                    <th><input type="hidden"  name="de1[]" class="form-control" value="{{$d->data_1}}"/>{{$d->data_1}}</th>
                                                    <td><input type="text"  name="de2[]" class="form-control" value="{{$d->data_2}}"/></td>
                                                    <td><input type="text"  name="de3[]" class="form-control" value="{{$d->data_3}}"/></td>
                                                    <td><input type="text"  name="de4[]" class="form-control" value="{{$d->data_4}}"/></td>

                                                </tr>
                                                    @endforeach
                                        @else

                                                    <tr>
                                                        <th><input type="hidden"  name="de1[]" class="form-control" value="Debtors Amount"/>Debtors Amount</th>
                                                        <td><input type="text"  name="de2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="de3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="de4[]" class="form-control"/></td>

                                                    </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="de1[]" class="form-control" value="Debtors days"/>Debtors days</th>
                                                        <td><input type="text"  name="de2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="de3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="de4[]" class="form-control"/></td>

                                                    </tr>
                                        @endif

                                    <tr>
                                        <td>Comment with reason, only if
                                            <ol>
                                                <li>The ratio is deteriorrating,</li>
                                                <li>if sharp variance, do an age analysis</li>

                                            </ol></td>
                                        <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="de_comment" rows="4">@if($debtor != null && $debtor !=""){{$debtor->comments}} @endif</textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                                <strong>7.Liquidity</strong>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-12">
                                <table class="table ">
                                    @if($liquidity !="" && $liquidity != null)
                                    <tr>
                                        <th rowspan="2">Year</th>
                                        <th><input type="text" name="li_date"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control" value="@if($liquidity->date_1 !=""){{date("d.m.Y",strtotime($liquidity->date_1))}}@endif"/></th>
                                        <th><input type="text" name="li_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control " value="@if($liquidity->date_2 !=""){{date("d.m.Y",strtotime($liquidity->date_2))}}@endif"/></th>
                                        <th><input type="text" name="li_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control " value="@if($liquidity->date_3 !=""){{date("d.m.Y",strtotime($liquidity->date_3))}}@endif"/></th>
                                    </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="li_date"    class="form-control" /></th>
                                            <th><input type="text" name="li_date1"    class="form-control " /></th>
                                            <th><input type="text" name="li_date1"    class="form-control " /></th>
                                        </tr>
                                        @endif
                                    <tr>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                    </tr>

                                                @if(count($liquidity->detail) > 0)
                                                    @foreach($liquidity->detail as $d)
                                                <tr>
                                                    <th><input type="hidden"  name="l1[]" class="form-control" value="{{$d->data_1}}"/>{{$d->data_1}}</th>
                                                    <td><input type="text"  name="l2[]" class="form-control" value="{{$d->data_2}}"/></td>
                                                    <td><input type="text"  name="l3[]" class="form-control" value="{{$d->data_3}}"/></td>
                                                    <td><input type="text"  name="l4[]" class="form-control" value="{{$d->data_4}}"/></td>

                                                </tr>
                                                    @endforeach
                                               @else


                                                <tr>
                                                    <th><input type="hidden"  name="l1[]" class="form-control" value="Current Ratio"/> Current Ratio</th>
                                                    <td><input type="text"  name="l2[]" class="form-control"/></td>
                                                    <td><input type="text"  name="l3[]" class="form-control"/></td>
                                                    <td><input type="text"  name="l4[]" class="form-control"/></td>

                                                </tr>
                                                 @endif

                                    <tr>
                                        <td>Comment with reason, only if
                                            <ol>
                                                <li>The ratio are in variance with norms,.</li>
                                                <li>There is exceptional change in trend there on</li>
                                                <li>Any exception performance.</li>
                                            </ol></td>
                                        <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="li_comment" rows="4">
                                                 @if($liquidity !="" && $liquidity != null)
                                                 {{$liquidity->comments}}
                                                 @endif
                                            </textarea></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="rows">
                            <div class="col-md-12">
                                <strong>8.Tangible Net Worth</strong>
                            </div>
                        </div>
                        <div class="rows">
                            <div class="col-md-12">
                                <table class="table ">
                                    @if($worth != null && $worth !="")
                                    <tr>
                                        <th rowspan="2">Year</th>
                                        <th><input type="text" name="w_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control" value="@if($worth->date_1 !=""){{date("d.m.Y",strtotime($worth->date_1))}}@endif"/></th>
                                        <th><input type="text" name="w_date2"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control " value="@if($worth->date_2 !=""){{date("d.m.Y",strtotime($worth->date_2))}}@endif"/></th>
                                        <th><input type="text" name="w_date3"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control " value="@if($worth->date_3 !=""){{date("d.m.Y",strtotime($worth->date_3))}}@endif"/></th>
                                    </tr>
                                    @else
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th></th>
                                            <th><input type="text" name="w_date2"    class="form-control " /></th>
                                            <th><input type="text" name="w_date3"    class="form-control " /></th>
                                        </tr>
                                        @endif
                                    <tr>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                        <th>Audited</th>
                                    </tr>

                                                @if(count($worth->detail) > 0)
                                                    @foreach($worth->detail as $d)
                                                <tr>
                                                    <th><input type="hidden"  name="w1[]" class="form-control" value="{{$d->data_1}}"/>{{$d->data_1}}</th>
                                                    <td><input type="text"  name="w2[]" class="form-control" value="{{$d->data_2}}"/></td>
                                                    <td><input type="text"  name="w3[]" class="form-control" value="{{$d->data_3}}"/></td>
                                                    <td><input type="text"  name="w4[]" class="form-control" value="{{$d->data_4}}"/></td>

                                                </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                        <th><input type="hidden"  name="w1[]" class="form-control" value="Tangible Net Worth"/>Tangible Net Worth</th>
                                                        <td><input type="text"  name="w2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="w3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="w4[]" class="form-control"/></td>

                                                    </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="w1[]" class="form-control" value="% of Total Assets"/>% of Total Assets</th>
                                                        <td><input type="text"  name="w2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="w3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="w4[]" class="form-control"/></td>

                                                    </tr>
                                                @endif



                                        @if($worth != null && $worth !="")
                                    <tr>
                                        <td>Is the company adquately capitalized</td>
                                        <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="w_comment" rows="4">{{$worth->comments}}</textarea></td>
                                    </tr>
                                            @else
                                            <tr>
                                                <td>Is the company adquately capitalized</td>
                                                <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="w_comment" rows="4"></textarea></td>
                                            </tr>
                                            @endif
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


</div>
    @else
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>FINANCIAL ANALYSIS</h4>
                    </div>
                    <div class="widget-content">

                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <strong>1. Sales</strong>
                                </div>
                            </div>
                            <div class="rows">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="d_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control"/></th>
                                            <th><input type="text" name="d_date2"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "/></th>
                                            <th><input type="text" name="d_date3"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "/></th>
                                        </tr>
                                        <tr>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                        </tr>

                                                    <tr>
                                                        <th><input type="hidden"  name="d1[]" class="form-control" value="Turnover" />Turnover</th>
                                                        <td><input type="text"  name="d2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="d3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="d4[]" class="form-control"/></td>

                                                    </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="d1[]" class="form-control" value="% Annual growth" />% Annual growth</th>
                                                        <td><input type="text"  name="d2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="d3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="d4[]" class="form-control"/></td>

                                                    </tr>


                                        <tr>
                                            <td>Comment with reason, only if
                                                <ol>
                                                    <li>The growth rate is errastic.</li>
                                                    <li>Any sharp fluctuation in any year.</li>
                                                    <li>Any exception performance.</li>
                                                </ol></td>
                                            <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."    name="d_comment" rows="3"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <strong>2. Profitability</strong>
                                </div>
                            </div>
                            <div class="rows">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="pr_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control"/></th>
                                            <th><input type="text" name="pr_date2"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "/></th>
                                            <th><input type="text" name="pr_date3"     data-rule-date="true" data-msg-date="The Field is not a valid date." class="form-control "/></th>
                                        </tr>
                                        <tr>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                        </tr>
                                                <tr>
                                                    <th><input type="text"  name="pr1[]" class="form-control"/></th>
                                                    <td><input type="text"  name="pr2[]" class="form-control"/></td>
                                                    <td><input type="text"  name="pr3[]" class="form-control"/></td>
                                                    <td><input type="text"  name="pr4[]" class="form-control"/></td>
                                                    <td> </td>
                                                    </tr>
                                                    <tr>
                                                        <th><input type="text"  name="pr1[]" class="form-control"/></th>
                                                        <td><input type="text"  name="pr2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="pr3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="pr4[]" class="form-control"/></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th><input type="text"  name="pr1[]" class="form-control"/></th>
                                                        <td><input type="text"  name="pr2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="pr3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="pr4[]" class="form-control"/></td>
                                                        <td><input type="button"class="btn btn-primary" value="Add Row" onclick="addRowProfitability();" /> </td>
                                                    </tr>

                                        <tr>
                                            <td>Comment with reason, only if
                                                <ol>
                                                    <li>The growth rate is errastic.</li>
                                                    <li>Any sharp fluctuation in any year.</li>
                                                    <li>Any exception performance.</li>
                                                </ol></td>
                                            <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="pr_comment" rows="4"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <strong>3. Gearing</strong>
                                </div>
                            </div>
                            <div class="rows">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="g_date1"  data-rule-date="true" data-msg-date="The Field is not a valid date."    class="form-control"/></th>
                                            <th><input type="text" name="g_date2"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control "/></th>
                                            <th><input type="text" name="g_date3"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control "/></th>
                                        </tr>
                                        <tr>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                        </tr>

                                                    <tr>
                                                        <th><input type="hidden"  name="ge1[]" class="form-control" value="Debit Equity"/>Debit Equity</th>
                                                        <td><input type="text"  name="ge2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ge3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ge4[]" class="form-control"/></td>

                                                    </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="ge1[]" class="form-control" value="Leverage"/>Leverage</th>
                                                        <td><input type="text"  name="ge2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ge3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ge4[]" class="form-control"/></td>

                                                    </tr>


                                        <tr>
                                            <td>Comment with reason, only if
                                                <ol>
                                                    <li>The ratio is deteriorating and </li>
                                                    <li>If convenants should be recommended to improve the position.</li>

                                                </ol></td>
                                            <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="g_comment" rows="4"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <strong>4. DSCR</strong>
                                </div>
                            </div>
                            <div class="rows">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <tr>
                                            <th rowspan="3">Year</th>
                                            <th><input type="text" name="dscr_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."    class="form-control"/></th>
                                            <th><input type="text" name="dscr_date2"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control "/></th>
                                            <th><input type="text" name="dscr_date3"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control "/></th>
                                        </tr>
                                        <tr>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                        </tr>
                                        <tr><input type="hidden"  name="DSCR1[]" class="form-control"/>
                                            <td><input type="text"  name="DSCR2[]" class="form-control"/></td>
                                            <td><input type="text"  name="DSCR3[]" class="form-control"/></td>
                                            <td><input type="text"  name="DSCR4[]" class="form-control"/></td>
                                        </tr>
                                        <tr>
                                            <td>Is it adequateto cover fresh borrowings</td>
                                            <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="dscr_comment" rows="4"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <strong>5.Creditors</strong>
                                </div>
                            </div>
                            <div class="rows">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="ce_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control"/></th>
                                            <th><input type="text" name="ce_date2"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "/></th>
                                            <th><input type="text" name="ce_date3"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "/></th>
                                        </tr>
                                        <tr>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                        </tr>

                                                    <tr>
                                                        <th><input type="hidden"  name="ce1[]" class="form-control" value="Creditor Amount">Creditor Amount</th>
                                                    <td><input type="text"  name="ce2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ce3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ce4[]" class="form-control"/></td>

                                                    </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="ce1[]" class="form-control" value="Creditor Days"/>Creditor Days</th>
                                                        <td><input type="text"  name="ce2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ce3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="ce4[]" class="form-control"/></td>

                                                    </tr>

                                        <tr>
                                            <td>Comment with reason, only if
                                                <ol>
                                                    <li>the ratio is deteriorating,</li>
                                                    <li>If sharp variance, do an age analysis</li>

                                                </ol></td>
                                            <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."    name="ce_comment" rows="4"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <strong>6.Debtors</strong>
                                </div>
                            </div>
                            <div class="rows">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="de_date1"  data-rule-date="true" data-msg-date="The Field is not a valid date."    class="form-control"/></th>
                                            <th><input type="text" name="de_date2"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "/></th>
                                            <th><input type="text" name="de_date3"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "/></th>
                                        </tr>
                                        <tr>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                        </tr>

                                                    <tr>
                                                        <th><input type="hidden"  name="de1[]" class="form-control" value="Debtors Amount"/>Debtors Amount</th>
                                                        <td><input type="text"  name="de2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="de3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="de4[]" class="form-control"/></td>

                                                    </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="de1[]" class="form-control" value="Debtors days"/>Debtors days</th>
                                                        <td><input type="text"  name="de2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="de3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="de4[]" class="form-control"/></td>

                                                    </tr>


                                        <tr>
                                            <td>Comment with reason, only if
                                                <ol>
                                                    <li>The ratio is deteriorrating,</li>
                                                    <li>if sharp variance, do an age analysis</li>

                                                </ol></td>
                                            <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="de_comment" rows="4"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <strong>7.Liquidity</strong>
                                </div>
                            </div>
                            <div class="rows">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="li_date1"  data-rule-date="true" data-msg-date="The Field is not a valid date."    class="form-control"/></th>
                                            <th><input type="text" name="li_date2"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control "/></th>
                                            <th><input type="text" name="li_date3"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control "/></th>
                                        </tr>
                                        <tr>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                        </tr>

                                                    <tr>
                                                        <th><input type="hidden"  name="l1[]" class="form-control" value="Current Ratio"/> Current Ratio</th>
                                                        <td><input type="text"  name="l2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="l3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="l4[]" class="form-control"/></td>

                                                    </tr>


                                        <tr>
                                            <td>Comment with reason, only if
                                                <ol>
                                                    <li>The ratio are in variance with norms,.</li>
                                                    <li>There is exceptional change in trend there on</li>
                                                    <li>Any exception performance.</li>
                                                </ol></td>
                                            <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="li_comment" rows="4"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="rows">
                                <div class="col-md-12">
                                    <strong>8.Tangible Net Worth</strong>
                                </div>
                            </div>
                            <div class="rows">
                                <div class="col-md-12">
                                    <table class="table ">
                                        <tr>
                                            <th rowspan="2">Year</th>
                                            <th><input type="text" name="w_date1"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control"/></th>
                                            <th><input type="text" name="w_date2"   data-rule-date="true" data-msg-date="The Field is not a valid date."   class="form-control "/></th>
                                            <th><input type="text" name="w_date3"    data-rule-date="true" data-msg-date="The Field is not a valid date."  class="form-control "/></th>
                                        </tr>
                                        <tr>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                            <th>Audited</th>
                                        </tr>

                                                    <tr>
                                                        <th><input type="hidden"  name="w1[]" class="form-control" value="Tangible Net Worth"/>Tangible Net Worth</th>
                                                        <td><input type="text"  name="w2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="w3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="w4[]" class="form-control"/></td>

                                                    </tr>
                                                    <tr>
                                                        <th><input type="hidden"  name="w1[]" class="form-control" value="% of Total Assets"/>% of Total Assets</th>
                                                        <td><input type="text"  name="w2[]" class="form-control"/></td>
                                                        <td><input type="text"  name="w3[]" class="form-control"/></td>
                                                        <td><input type="text"  name="w4[]" class="form-control"/></td>

                                                    </tr>

                                        <tr>
                                            <td>Is the company adquately capitalized</td>
                                            <td colspan="3"><textarea class="form-control" data-msg-alpha_dash="The field may only contain letters, numbers, and dashes."   name="w_comment" rows="4"></textarea></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>


    </div>
@endif
<div class="row" style="margin-left: 20px; margin-bottom: 30px">
    <div class="col-md-12">
        <div class="col-md-2 pull-right">
            <a href="#" data-dismiss="modal"  class="btn btn-danger btn-block"> <i class="icon-remove"></i>  Cancel</a>
        </div>
        <div class="col-md-2 pull-right">
            <button type="submit" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
            <input type="hidden" name="id" value="@if(old('id') != "") {{old('id')}} @else {{$id}} @endif"/>
            <input type="hidden" name="crp_id" value="@if(old('crp_id') != "") {{old('crp_id')}} @else {{$crid}} @endif"/>
            <input type="hidden" name="apprequest" value="@if(old('apprequest') != "") {{old('apprequest')}} @else {{$apprequest}} @endif"/>
        </div>
        <div id="output" class="col-md-8"></div>
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

    function addsales()
    {
        var table = document.getElementById('sales');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML=" <input type='text' class='form-control' name='d1[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='d2[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='d3[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='d4[]'>";
        cel5.innerHTML="  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
    }

    function addRowworth()
    {
        var table = document.getElementById('worth');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML=" <input type='text' class='form-control' name='w1[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='w2[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='w3[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='w4[]'>";
        cel5.innerHTML="  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
    }

    function addRowliquidity()
    {
        var table = document.getElementById('liquidity');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML=" <input type='text' class='form-control' name='l1[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='l2[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='l3[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='l4[]'>";
        cel5.innerHTML="  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
    }

    function addRowDebtors()
    {
        var table = document.getElementById('debtors');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML="<input type='text' class='form-control' name='de1[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='de2[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='de3[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='de4[]'>";
        cel5.innerHTML="  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
    }
    function addRowCreditors()
    {
        var table = document.getElementById('creditors');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML="<input type='text' class='form-control' name='ce1[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='ce2[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='ce3[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='ce4[]'>";
        cel5.innerHTML="  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
    }

    function addRowDSCR()
    {
        var table = document.getElementById('DSCR');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML="<input type='text' class='form-control' name='DSCR1[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='DSCR2[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='DSCR3[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='DSCR4[]'>";
        cel5.innerHTML="  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
    }
    function addRowGearing()
    {
        var table = document.getElementById('gearing');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML="<input type='text' class='form-control' name='ge1[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='ge2[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='ge3[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='ge4[]'>";
        cel5.innerHTML="  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
    }
    function addRowProfitability()
    {
        var table = document.getElementById('profitability');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML="<input type='text' class='form-control' name='pr1[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='pr2[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='pr3[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='pr4[]'>";
        cel5.innerHTML="  <a href='#' class='deloptsec btn btn-danger' id='yes' onclick='rmOption(this);'>Remove record</a>";
    }

    function rmOption(o)
    {
        var p=o.parentNode.parentNode;
        p.parentNode.removeChild(p);
    }
</script>