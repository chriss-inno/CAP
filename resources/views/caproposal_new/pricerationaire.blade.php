<?php
$crid=$crp->id;
$apprequest =0;
$id=0;
$pric="";
$details="";
$coments="";
if( count($crp->pricingrationale) >0 )
{
    $apprequest=1;
    $pric=$crp->pricingrationale;
    $id=$pric->id;
    $details=$pric->details;
    $coments=$pric->coments;
}
?>
{!! Form::open(array('url' => 'pricingrationale', 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
<div class="row row-bg">
    <div class="row">
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>E: Pricing rationale</h4>
                </div>
                <div class="widget-content">

                    <div class="form-group">
                        <div class="col-md-12">
                            <h3 class="text-info">Account profitability  estimated at 80% utilization of the overdraft)
                                figures in tzs "mio"
                            </h3>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">

                            <table class="table" id="princingTB">
                                <tr>
                                    <th>Facility</th>
                                    <th>Total annual interest</th>
                                    <th>Fees</th>

                                    <th></th>
                                </tr>
                                @if($details !="" && count($details) >0)
                                    @foreach($details as $dt)
                                <tr>
                                    <td><input type="text" class="form-control" name="p_facility[]" value="{{$dt->facility}}"></td>
                                    <td><input type="text" class="form-control" name="p_interest[]" value="{{$dt->anual_interest}}"></td>
                                    <td><input type="text" class="form-control" name="p_fees[]" value="{{$dt->fees}}"></td>
                                    <td></td>
                                </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td><input type="text" class="form-control" name="p_facility[]"></td>
                                    <td><input type="text" class="form-control" name="p_interest[]"></td>
                                    <td><input type="text" class="form-control" name="p_fees[]"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><input type="text" class="form-control" name="p_facility[]"></td>
                                    <td><input type="text" class="form-control" name="p_interest[]"></td>
                                    <td><input type="text" class="form-control" name="p_fees[]"></td>
                                    <td><input type="button" value="Add" class="btn btn-primary" onclick="addRowPricing();"></td>
                                </tr>

                            </table>
                            <table class="table">

                                <tr>
                                    <td class="col-md-6">1)	If the earnings in fees and commission adequately supplement the interest income.</td>
                                    <td class="col-md-6" rowspan="3"><textarea name="coments" cols="4" rows="8" class="form-control" required="required">{{$coments}}</textarea>
                                       </td>
                                </tr>
                                <tr>
                                    <td >2)	Is there any other reason to justify the proposed pricing- competition, market condition</td>

                                </tr>
                                <tr>
                                    <td >3)	Comment if there is any exceptions to the pricing grid as mentioned in the credit grading norm and the credit policy</td>

                                </tr>


                            </table>
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
            <button type="button" name="Submit" id="submitButton" class="btn btn-info  btn-block"> <i class="icon-save"></i> Save </button>
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
                    url: '<?php echo url('pricingrationale') ?>',
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

    function addRowCon()
    {
        var table = document.getElementById('convTB');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);
        var cel5 = row.insertCell(4);

        cell.innerHTML=" <input type='text' class='form-control' name='pricing[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='facility[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='spread[]'>";
        cel4.innerHTML="<input type='text' class='form-control' name='effective_rate[]'>";
        cel5.innerHTML="<input type='button' name='button' id='button' value='Delete' class='btn btn-danger' />";
    }

    function addRowPricing()
    {
        var table = document.getElementById('princingTB');
        var row = table.insertRow(-1);
        var cell = row.insertCell(0);
        var cel2 = row.insertCell(1);
        var cel3 = row.insertCell(2);
        var cel4 = row.insertCell(3);


        cell.innerHTML=" <input type='text' class='form-control' name='p_facility[]'>";
        cel2.innerHTML="<input type='text' class='form-control' name='p_interest[]'>";
        cel3.innerHTML="<input type='text' class='form-control' name='p_fees[]'>";
        cel4.innerHTML="<input type='button' name='button' id='button' value='Delete' class='btn btn-danger' />";
    }
</script>

