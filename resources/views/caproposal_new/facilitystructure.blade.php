<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$open_type="";
$app_type="";
$valid_date="";
$Limits="";
$purpose="";
$remarks="";
$rate_applied="";
$fsg="";
        //Get initial
$open_type=$crp->open_type;
$app_type=$crp->app_type;
if( count($crp->facilitystructure) !=0 )
{
    $apprequest=1;

    $valid_date=$crp->facilitystructure->valid_date;

    $purpose=$crp->facilitystructure->purpose;
    $remarks=$crp->facilitystructure->remarks;
    $rate_applied=$crp->facilitystructure->rate_applied;
    $fsg=$crp->facilitystructure->facilitygroups;
    $Limits =$crp->facilitystructure->facilitylimits;
    $id=$crp->facilitystructure->id;

}
?>
    {!! Form::open(array('url' => 'facility-structure', 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i> B: Facility Structure </h4>
                    </div>
                    <div class="widget-content">

                            <div class="form-group">

                                <div class="col-md-4 text-info" >TYPE OF APPLICATION</div>
                                <div class="col-md-4 text-info pull-right" ><input type="date" class="form-control" name="valid_date"  value="{{$valid_date}}" /> </div>
                                <div class="col-md-4 text-info pull-right" style="text-align: right">VALID UP TO </div>

                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-4">
                                                New
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control" @if($open_type =="New") checked="checked" @endif disabled="disabled" />
                                            </div>
                                            <div class="col-md-4">
                                                Existing level
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control" @if($app_type =="Existing level") checked="checked" @endif disabled="disabled"/>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Renewal
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control" @if($open_type =="Renewal") checked="checked" @endif disabled="disabled"/>
                                            </div>
                                            <div class="col-md-4">
                                                Enhancement
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" @if($app_type =="Enhancement") checked="checked" @endif class="form-control" disabled="disabled"/>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                Interim
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" class="form-control"  @if($open_type =="Interim") checked="checked" @endif disabled="disabled"/>
                                            </div>
                                            <div class="col-md-4">
                                                Amendment
                                            </div>
                                            <div class="col-md-2">
                                                <input type="checkbox" @if($app_type =="Amendment") checked="checked" @endif class="form-control" disabled="disabled"/>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col-md-12 text-info" style="text-align: right" ><h2>Limit in ACY | Outstanding in LCY </h2> </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                    <table class="table" id="fsapp">
                                        <thead>
                                            <th class="col-md-3">Facility</th>
                                            <th class="col-md-1">CCY</th>
                                            <th>Current limits</th>
                                            <th class="col-md-1">CCY</th>
                                            <th>Out Standing </th>
                                            <th class="col-md-1">Proposed </th>
                                            <th>Tenor / expiry </th>
                                            <th></th>
                                        </thead>
                                        <tbody>

                                        @if($Limits != null && count($Limits) >0 )
                                            @foreach($Limits as $l)

                                        <tr>
                                            <td><input type="text" name="facility[]" class="form-control" value="{{$l->facility}}"></td>
                                            <td><input type="text" name="ccy_1[]" class="form-control" value="{{$l->ccy_1}}"></td>
                                            <td><input type="text" name="cr_limits[]" class="form-control" value="{{$l->cr_limits}}"></td>
                                            <td><input type="text" name="ccy_2[]" class="form-control" value="{{$l->ccy_2}}"></td>
                                            <td><input type="text" name="presentos[]" class="form-control" value="{{$l->presentos}}"></td>
                                            <td><input type="text" name="proposed[]" class="form-control" value="{{$l->proposed}}"></td>
                                            <td><input type="text" name="expire[]" class="form-control" value="{{$l->expire}}"></td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <td><input type="text" name="facility[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_1[]" class="form-control"></td>
                                            <td><input type="text" name="cr_limits[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_2[]" class="form-control"></td>
                                            <td><input type="text" name="presentos[]" class="form-control"></td>
                                            <td><input type="text" name="proposed[]" class="form-control"></td>
                                            <td><input type="text" name="expire[]" class="form-control"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="facility[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_1[]" class="form-control"></td>
                                            <td><input type="text" name="cr_limits[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_2[]" class="form-control"></td>
                                            <td><input type="text" name="presentos[]" class="form-control"></td>
                                            <td><input type="text" name="proposed[]" class="form-control"></td>
                                            <td><input type="text" name="expire[]" class="form-control"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="facility[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_1[]" class="form-control"></td>
                                            <td><input type="text" name="cr_limits[]" class="form-control"></td>
                                            <td><input type="text" name="ccy_2[]" class="form-control"></td>
                                            <td><input type="text" name="presentos[]" class="form-control"></td>
                                            <td><input type="text" name="proposed[]" class="form-control"></td>
                                            <td><input type="text" name="expire[]" class="form-control"></td>
                                            <td> <input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFS();" /></td>
                                        </tr>


                                        </tbody>

                                    </table>
                                </div>
                                </div>

                            </div>
                            <div class="form-group">

                                <div class="col-md-2" ><strong>Rate Applied </strong> </div>
                                <div class="col-md-1"><input type="text" class="form-control" value="{{$rate_applied}}" name="rate_applied" > </div>

                            </div>
                            <div class="form-group">

                                <div class="col-md-2"><strong>Remarks</strong> </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea name="remarks" id="remarks" cols="45" rows="8" class="form-control">{{$remarks}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 ">As per the BOT guideline on Credit Concentration, Our Single Borrower Limit (SBL) AND group exposer limit (GEL) of the bank at 25% of the core capital works out at TZS 14.79 billion. Accordingly the proposal may be considered for the full amount applied as per the details above. </div>

                            </div>
                            <div class="form-group">

                                <div class="col-md-12 text-info" style="text-align: right" ><h2>Group exposure  figures in tzs "mio" and usd"000"</h2> </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                <div class="col-md-12">
                                    <table class="table" id="fsge">
                                        <thead>
                                        <th class="col-md-2">Client</th>
                                        <th class="col-md-2">Facility</th>
                                        <th class="col-md-1">Ccy</th>
                                        <th>Existing limit </th>
                                        <th>O/s bal as of  </th>
                                        <th>Proposed limit </th>
                                        <th class="col-md-1">GEL</th>
                                        <th></th>
                                        </thead>
                                        <tbody>

                                        @if($fsg != null && count($fsg) >0)
                                         @foreach($fsg as $g)
                                        <tr>
                                            <td><input type="text" name="g_client[]" class="form-control" value="{{$g->client}}"></td>
                                            <td><input type="text" name="g_facility[]" class="form-control" value="{{$g->facility}}"></td>
                                            <td><input type="text" name="g_ccy[]" class="form-control" value="{{$g->ccy}}"></td>
                                            <td><input type="text" name="g_existing_limit[]" class="form-control" value="{{$g->existing_limit}}"></td>

                                            <td><input type="text" name="g_osbalance[]" class="form-control" value="{{$g->osbalance}}"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control" value="{{$g->proposed_limit}}"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control" value="{{$g->gel}}"></td>
                                            <td class="col-md-2"></td>
                                        </tr>
                                         @endforeach
                                        @endif
                                        <tr>
                                            <td><input type="text" name="g_client[]" class="form-control"></td>
                                            <td><input type="text" name="g_facility[]" class="form-control"></td>
                                            <td><input type="text" name="g_ccy[]" class="form-control"></td>
                                            <td><input type="text" name="g_existing_limit[]" class="form-control"></td>

                                            <td><input type="text" name="g_osbalance[]" class="form-control"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control"></td>
                                            <td class="col-md-2"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="g_client[]" class="form-control"></td>
                                            <td><input type="text" name="g_facility[]" class="form-control"></td>
                                            <td><input type="text" name="g_ccy[]" class="form-control"></td>
                                            <td><input type="text" name="g_existing_limit[]" class="form-control"></td>

                                            <td><input type="text" name="g_osbalance[]" class="form-control"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control"></td>
                                            <td class="col-md-2"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="g_client[]" class="form-control"></td>
                                            <td><input type="text" name="g_facility[]" class="form-control"></td>
                                            <td><input type="text" name="g_ccy[]" class="form-control"></td>
                                            <td><input type="text" name="g_existing_limit[]" class="form-control"></td>

                                            <td><input type="text" name="g_osbalance[]" class="form-control"></td>
                                            <td><input type="text" name="g_proposed_limit[]" class="form-control"></td>
                                            <td><input type="text" name="g_gel[]" class="form-control"></td>
                                            <td class="col-md-2"><input type="button" name="button" id="button" value="Add new record" class="btn-block btn-primary btn" onclick="addRowFSGE();" /></td>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12 ">As per the bot guidelines on credit concentration, our single borrower limit (sbl) and group exposure limit (gel) of the bank at 25% of the core capital works out at tzs 15.93 billion. The proposed facilities are within our current sbl / gel. </div>

                            </div>
                           <div class="form-group">
                            <div class="col-md-12 "><strong>Purpose</strong></div>
                            </div>
                            <div class="form-group">

                                <div class="col-md-12">
                                <textarea name="purpose" rows="4" id="purpose" class="form-control"> {{$purpose}}</textarea> </div>
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
                <button type="button" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
                <input type="hidden" name="id" value="@if(old('id') != "") {{old('id')}} @else {{$id}} @endif"/>
                <input type="hidden" name="crid" value="@if(old('crid') != "") {{old('crid')}} @else {{$crid}} @endif"/>
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
                        url: '<?php echo url('facility-structure') ?>',
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
            var table = document.getElementById('fsapp');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);
            var cel4 = row.insertCell(3);
            var cel5 = row.insertCell(4);
            var cel6 = row.insertCell(5);
            var cel7 = row.insertCell(6);
            var cel8 = row.insertCell(7);

            cell.innerHTML="<input type='text' name='facility[]' class='form-control'>";
            cel2.innerHTML="<input type='text' name='ccy_1[]' class='form-control'>";
            cel3.innerHTML="<input type='text' name='cr_limits[]' class='form-control'>";
            cel4.innerHTML="<input type='text' name='ccy_2[]' class='form-control'>";
            cel5.innerHTML="<input type='text' name='presentos[]' class='form-control'>";
            cel6.innerHTML="<input type='text' name='proposed[]' class='form-control'>";
            cel7.innerHTML="<input type='text' name='expire[]' class='form-control'>";

            cel8.innerHTML="<input type='button' name='button' id='delbtn' value='Delete' class='btn btn-danger' />";
        }

        function addRowFSGE()
        {
            var table = document.getElementById('fsge');
            var row = table.insertRow(-1);
            var cell = row.insertCell(0);
            var cel2 = row.insertCell(1);
            var cel3 = row.insertCell(2);
            var cel4 = row.insertCell(3);
            var cel5 = row.insertCell(4);
            var cel6 = row.insertCell(5);
            var cel7 = row.insertCell(6);
            var cel8 = row.insertCell(7);

            cell.innerHTML="<input type='text' name='g_client[]' class='form-control'>";
            cel2.innerHTML="<input type='text' name='g_facility[]' class='form-control'>";
            cel3.innerHTML="<input type='text' name='g_ccy[]' class='form-control'>";
            cel4.innerHTML="<input type='text' name='g_existing_limit[]' class='form-control'>";

            cel5.innerHTML="<input type='text' name='g_osbalance[]' class='form-control'>";
            cel6.innerHTML="<input type='text' name='g_proposed_limit[]' class='form-control'>";
            cel7.innerHTML="<input type='text' name='g_gel[]' class='form-control'>";
            cel8.innerHTML="<input type='button' name='button' id='button' value='Delete' class='btn btn-danger' />";

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
