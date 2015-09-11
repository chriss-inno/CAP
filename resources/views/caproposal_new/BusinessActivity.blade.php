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
{!! Form::open(array('url' =>url('business-activity'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
    <div class="row row-bg">
        <div class="row" >
            <div class="col-md-12">
                <div class="widget box">
                    <div class="widget-header">
                        <h4><i class="icon-reorder"></i>G: Business Activity</h4>
                    </div>
                    <div class="widget-content">

                                <div class="form-group">

                                           <div class="col-md-12">Business Activity</div>
                                </div>
                                <div class="form-group">
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="business_activity" >{{$business_activity}}</textarea>
                                        </div>
                                </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                 <strong>Organization Headquarters and hubs</strong>
                                <p><ol>
                                    <li>Location of the HQ</li>
                                    <li>Distribution network</li>
                                    <li>Any overseas Principal</li>
                                </ol></p>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="org_hq" rows="5" >{{$org_hq}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <strong>Products Traded</strong>
                                <p><ol>
                                    <li>List of products the parent company of the products, and their share in the company Turnover, Local or imported</li>
                                </ol></p>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="product_traded" rows="5" >{{$product_traded}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <strong>Procurement and Credit terms</strong>
                                <p><ol>
                                    <li>Location of the HQ</li>
                                    <li>Distribution network</li>
                                    <li>Any overseas Principal</li>
                                </ol></p>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="credit_terms"  rows="5">{{$credit_terms}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <strong>Sales and Distribution</strong>
                                <p><ol>
                                    <li>Location of the HQ</li>
                                    <li>Distribution network</li>
                                    <li>Any overseas Principal</li>
                                </ol></p>
                            </div>
                            <div class="col-md-9">
                                <textarea class="form-control" name="sales_distributions" rows="5" >{{$sales_distributions}}</textarea>
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
                    url: '<?php echo url('business-activity') ?>',
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
</script>


