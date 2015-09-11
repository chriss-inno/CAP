<?php
$sno = $crp->sno;
$app_date=$crp->app_date;
$open_type=$crp->open_type;
$app_type=$crp->app_type;
$ac_name=$crp->ac_name;
$acaddress=$crp->ac_address;

$crid=$crp->id;
$apprequest =0;
$id=0;
$apb="";
$comments="";
$aptz="";
$apusd="";

    if( count($crp->accountperformance) !=0 )
    {
        $apprequest=1;
        $apb=$crp->accountperformance->accountperformanceBank;
        $aptz=$crp->accountperformance->accountperformanceTZS;
        $apusd=$crp->accountperformance->accountperformanceUSD;
        $id=$crp->accountperformance->id;
        $comments=$crp->accountperformance->comments;

    }
?>

    {!! Form::open(array('url' => 'account-performance', 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>F: Account performance</h4>
                    </div>
                    <div class="widget-content">

                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table id="dubu" class="table">

                                        @if(count($apb) > 0 && $apb !=""  )
                                            @foreach($apb as $bk)
                                        <tr>
                                            <td>
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th>1)	Names of the banks where the accounts are maintained. </th>
                                                        <th colspan="2" align="right"><input type="text"class="form-control" name="bank_maintained[]" value="{{$bk->bank_maintained}}"></th>
                                                        <th> </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th colspan="4" style="text-align: right;"><strong><h2 class="text-primary">Figures in TZS  "000" </h2></strong></th>

                                                    </tr>

                                                    <tr>
                                                        <th>Month</th>
                                                        <th>Low balance</th>
                                                        <th>High balance</th>
                                                        <th>Turnover</th>
                                                    </tr>
                                                    <?php $c=0; ?>
                                                    @foreach($aptz as $tz)
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="tzs_month[]" value="{{$tz->tzs_month}}"/></td>
                                                        <td><input type="text" class="form-control" name="tzs_low_balance[]" value="{{$tz->tzs_low_balance}}"/></td>
                                                        <td><input type="text" class="form-control" name="tzs_high_balance[]" value="{{$tz->tzs_high_balance}}"/></td>
                                                        <td><input type="text" class="form-control" name="tzs_turnover[]" value="{{$tz->tzs_turnover}}"/></td>
                                                    </tr>
                                                        <?php $c++; ?>
                                                    @endforeach
                                                    <?php
                                                     $remain=12-$c;
                                                            for($i =0; $i<$remain; $i++)
                                                            {
                                                    ?>

                                                    <tr>
                                                        <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                        <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                        <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                        <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                    </tr>
                                                    <?php } ?>

                                                    <tr>
                                                        <td  colspan="3"><strong>Total</strong></td>
                                                        <td><input type="text" class="form-control"  name="total[]" value="{{$bk->total_tzs}}"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td  colspan="3" ><strong>Less term loan disbursement
                                                                <small>Internal fund transfers</small>
                                                            </strong></td>

                                                        <td ><input type="text" class="form-control" name="loan_disbursement[]" value="{{$bk->loan_disbursement_tzs}}" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td  colspan="3" ><strong>Actual credit turnover
                                                            </strong></td>

                                                        <td><input type="text" class="form-control" name="Credit_turnover[]"  value="{{$bk->Credit_turnover_tzs}}" /></td>
                                                    </tr>




                                                    </tbody>
                                                </table>
                                                <table class="table">
                                                    <thead>
                                                    </thead>
                                                    <tr>
                                                        <td colspan="4" align="right"><strong>
                                                                <h2 class="text-primary">Figures in USD  &quot;000&quot; </h2>
                                                            </strong>
                                                        </th>
                                                        </thead></td>
                                                    </tr>
                                                    <tbody>
                                                    <tr>
                                                        <th>Month</th>
                                                        <th>Low balance</th>
                                                        <th>High balance</th>
                                                        <th>Turnover</th>
                                                    </tr>
                                                    <?php $cu=0; ?>
                                                    @foreach($apusd as $us)
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="usd_month[]" value="{{$us->usd_month}}"/></td>
                                                        <td><input type="text" class="form-control" name="usd_lbalance[]" value="{{$us->usd_low_balance}}"/></td>
                                                        <td><input type="text" class="form-control" name="usd_hbalance[]"  value="{{$us->usd_high_balance}}"/></td>
                                                        <td><input type="text" class="form-control" name="usd_turnover[]" value="{{$us->usd_turnover}}"/></td>
                                                    </tr>
                                                    <?php $cu++; ?>
                                                    @endforeach
                                                    <?php $remainu=12 -$cu;
                                                     for($j=0; $j<$remainu ; $j++)
                                                            {
                                                    ?>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                        <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                        <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                        <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                    </tr>
                                                    <?php } ?>
                                                    <tr>
                                                        <td  colspan="3"><strong>Total</strong></td>
                                                        <td><input type="text" class="form-control"  name="total[]" value="{{$bk->total_usd}}"/></td>
                                                    </tr>
                                                    <tr>
                                                        <td  colspan="3" ><strong>Less term loan disbursement
                                                                <small>Internal fund transfers</small>
                                                            </strong></td>

                                                        <td ><input type="text" class="form-control" name="loan_disbursement[]" value="{{$bk->loan_disbursement_usd}}" /></td>
                                                    </tr>
                                                    <tr>
                                                        <td  colspan="3" ><strong>Actual credit turnover
                                                            </strong></td>

                                                        <td><input type="text" class="form-control" name="Credit_turnover[]"  value="{{$bk->Credit_turnover_usd}}" /></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /></td>

                                        </tr>
                                       @endforeach
                                        @else
                                            <tr>
                                                <td>
                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>1)	Names of the banks where the accounts are maintained. </th>
                                                            <th colspan="2" align="right"><input type="text"class="form-control" name="bank_maintained[]"></th>
                                                            <th> </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <th colspan="4" style="text-align: right;"><strong><h2 class="text-primary">Figures in TZS  "000" </h2></strong></th>

                                                        </tr>

                                                        <tr>
                                                            <th>Month</th>
                                                            <th>Low balance</th>
                                                            <th>High balance</th>
                                                            <th>Turnover</th>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="tzs_month[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_low_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_high_balance[]"/></td>
                                                            <td><input type="text" class="form-control" name="tzs_turnover[]"/></td>
                                                        </tr>

                                                        <tr>
                                                            <td  colspan="3"><strong>Total</strong></td>
                                                            <td><input type="text" class="form-control"  name="total[]"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td  colspan="3" ><strong>Less term loan disbursement
                                                                    <small>Internal fund transfers</small>
                                                                </strong></td>

                                                            <td ><input type="text" class="form-control" name="loan_disbursement[]" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td  colspan="3" ><strong>Actual credit turnover
                                                                </strong></td>

                                                            <td><input type="text" class="form-control" name="Credit_turnover[]" /></td>
                                                        </tr>




                                                        </tbody>
                                                    </table>
                                                    <table class="table">
                                                      <thead>
                                                      </thead>
                                                      <tr>
                                                        <td colspan="4" align="right"><strong>
                                                          <h2 class="text-primary">Figures in USD  &quot;000&quot; </h2>
                                                          </strong>
                                                          </th>
                                                          </thead></td>
                                                      </tr>
                                                      <tbody>
                                                        <tr>
                                                          <th>Month</th>
                                                          <th>Low balance</th>
                                                          <th>High balance</th>
                                                          <th>Turnover</th>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td><input type="text" class="form-control" name="usd_month[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_lbalance[]"/></td>
                                                          <td><input type="text" class="form-control" name="usd_hbalance[]" /></td>
                                                          <td><input type="text" class="form-control" name="usd_turnover[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td  colspan="3"><strong>Total</strong></td>
                                                          <td><input name="total_usd[]" type="text" class="form-control" id="total_usd[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td  colspan="3" ><strong>Less term loan disbursement</strong> <small>Internal fund transfers</small></td>
                                                          <td><input name="loan_disbursement_usd[]" type="text" class="form-control" id="loan_disbursement_usd[]" /></td>
                                                        </tr>
                                                        <tr>
                                                          <td  colspan="3" ><strong>Actual credit turnover </strong></td>
                                                          <td><input name="Credit_turnover_usd[]" type="text" class="form-control" id="Credit_turnover_usd[]" /></td>
                                                        </tr>
                                                      </tbody>
                                                </table>

                                                </td>
                                                <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /></td>

                                            </tr>
                                            @endif
                                    </table>
                                </div>

                            </div>
                        </div>
                         <div class="row"></div>
                      <div class="row">
                            <div class="form-group">
                                <div class="col-md-12"></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <table class="table">
                                        <tr>
                                            <td class="col-md-6" >
                                                <ol>
                                                    <li>Do the summations indicate adequate banking in comparison to  the volume of sales</li>
                                                    <li>If too low, the reasons there for.</li>
                                                </ol>
                                            </td>

                                            <td class="col-md-6" ><textarea name="comments" cols="4" rows="4" class="form-control" required="required">{{$comments}}</textarea></td>
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
        $('#submitButton').click( function() {

            function getDoc(frame) {
                var doc = null;

                // IE8 cascading access check
                try {
                    if (frame.contentWindow) {
                        doc = frame.contentWindow.document;
                    }
                } catch(err) {
                }

                if (doc) { // successful getting content
                    return doc;
                }

                try { // simply checking may throw in ie8 under ssl or mismatched protocol
                    doc = frame.contentDocument ? frame.contentDocument : frame.document;
                } catch(err) {
                    // last attempt
                    doc = frame.document;
                }
                return doc;
            }
            $("#FileUploader").submit(function(e)
            {

                var formObj = $(this);
                var formURL = formObj.attr("action");

                if(window.FormData !== undefined)  // for HTML5 browsers
                {

                    var formData = new FormData(this);
                    $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Making changes please wait...</span><h3>");
                    $.ajax({
                        url: '<?php echo url('account-performance') ?>',
                        type: 'POST',
                        data:  formData,
                        mimeType:"multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(data, textStatus, jqXHR)
                        {
                            $("#appcontentslist").load("<?php echo url("credit-proposal/app/").$crid; ?>");
                            $("#output").html("<h3><span class='text-success'>Successiful saved <h3>");
                            setTimeout(function() {
                                $("#myModal").modal("hide");
                            }, 3000);
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            $("#output").html("<h3><span class='text-info'><i class='icon-spinner icon-spin'></i> Error in processing data try again...</span><h3>");
                            $("#appcontentslist").load("<?php echo url("credit-proposal/app/").$crid; ?>");
                            $("#output").html("<h3><span class='text-success'>Successiful saved <h3>");
                            setTimeout(function() {
                                $("#myModal").modal("hide");
                            }, 3000);
                        }
                    });
                    e.preventDefault();
                    e.unbind();
                }
                else  //for olden browsers
                {
                    //generate a random id
                    var  iframeId = 'unique' + (new Date().getTime());

                    //create an empty iframe
                    var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

                    //hide it
                    iframe.hide();

                    //set form target to iframe
                    formObj.attr('target',iframeId);

                    //Add iframe to body
                    iframe.appendTo('body');
                    iframe.load(function(e)
                    {
                        var doc = getDoc(iframe[0]);
                        var docRoot = doc.body ? doc.body : doc.documentElement;
                        var data = docRoot.innerHTML;
                        //data is returned from server.

                    });

                }
            });
            $("#FileUploader").submit();
        });


        function addRowFS()
        {
            var table = document.getElementById('dubu');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);

            cell.innerHTML="  <table class='table'>       <thead>       <tr>       <th>1)	Names of the banks where the accounts are maintained. </th>       <th colspan='2' align='right'><input type='text'class='form-control' name='bank_maintained[]'></th><th> </th>       </tr>       </thead>       <tbody>       <tr><th colspan='4' style='text-align: right;'><strong><h2 class='text-primary'>Figures in TZS '000' </h2></strong></th>       </tr>       <tr><th>Month</th><th>Low balance</th><th>High balance</th><th>Turnover</th>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td><input type='text' class='form-control' name='tzs_month[]'/></td><td><input type='text' class='form-control' name='tzs_low_balance[]'/></td><td><input type='text' class='form-control' name='tzs_high_balance[]'/></td><td><input type='text' class='form-control' name='tzs_turnover[]'/></td>       </tr>       <tr><td colspan='3'><strong>Total</strong></td><td><input type='text' class='form-control' name='total[]'/></td>       </tr>       <tr><td colspan='3' ><strong>Less term loan disbursement  <small>Internal fund transfers</small> </strong></td><td ><input type='text' class='form-control' name='loan_disbursement[]' /></td>       </tr>       <tr><td colspan='3' ><strong>Actual credit turnover </strong></td><td><input type='text' class='form-control' name='Credit_turnover[]' /></td>       </tr>       </tbody>      </table> <table class='table'><thead></thead><tr><td colspan='4' align='right'><strong><h2 class='text-primary'>Figures in USD  &quot;000&quot; </h2></strong></th></thead></td></tr><tbody><tr><th>Month</th><th>Low balance</th><th>High balance</th><th>Turnover</th></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td><input type='text' class='form-control' name='usd_month[]' /></td><td><input type='text' class='form-control' name='usd_lbalance[]'/></td><td><input type='text' class='form-control' name='usd_hbalance[]' /></td><td><input type='text' class='form-control' name='usd_turnover[]' /></td></tr><tr><td  colspan='3'><strong>Total</strong></td><td><input name='total_usd[]' type='text' class='form-control' id='total_usd[]' /></td></tr><tr><td  colspan='3' ><strong>Less term loan disbursement</strong> <small>Internal fund transfers</small></td><td><input name='loan_disbursement_usd[]' type='text' class='form-control' id='loan_disbursement_usd[]' /></td></tr><tr><td  colspan='3' ><strong>Actual credit turnover </strong></td><td><input name='Credit_turnover_usd[]' type='text' class='form-control' id='Credit_turnover_usd[]' /></td></tr></tbody></table>";
            cel2.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
        }
        function addRowFS2()
        {
            var table = document.getElementById('dubu2');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);

            cell.innerHTML="  <table class='table'><thead><td colspan='4' align='right'> <strong><h2 class='text-primary'>Figures in USD  '000' </h2></strong></th></thead><tbody><tr> <th>Month</th> <th>Low balance</th> <th>High balance</th> <th>Turnover</th></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td><input type='text' class='form-control' name='usd_month[]' /></td> <td><input type='text' class='form-control' name='usd_lbalance[]'/></td> <td><input type='text' class='form-control' name='usd_hbalance[]'></td> <td><input type='text' class='form-control' name='usd_turnover[]'></td></tr><tr> <td  colspan='3'><strong>Total</strong></td> <td><input type='text' class='form-control'></td></tr><tr> <td  colspan='3' ><strong>Less term loan disbursement</strong><small>Internal fund transfers</small>  </td> <td><input type='text' class='form-control'></td></tr><tr> <td  colspan='3' ><strong>Actual credit turnover  </strong></td> <td><input type='text' class='form-control'></td></tr></tbody></table>";

            cel2.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
        }

        function removeCurrentRow(btn)
        {
            var pr= btn.parentNode.parentNode.nodeName;
            alert(pr);
        }
        $('#delbtn').click(function(e){
            $(this).closest('tr').remove()
        })
    </script>
