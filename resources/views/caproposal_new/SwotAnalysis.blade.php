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
    $swot_issues=$crp->swotanalysis->swot_issues;
    $apprequest=1;
}
?>

{!! Form::open(array('url' =>url('swot-analysis'), 'class' => 'form-horizontal row-border','id'=>'FileUploader')) !!}
<div class="row row-bg">
    <div class="row" >
        <div class="col-md-12">
            <div class="widget box">
                <div class="widget-header">
                    <h4><i class="icon-reorder"></i>swot Analysis</h4>
                </div>
                <div class="widget-content">

                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Strength </strong>

                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="swot_strength" >{{$swot_strength}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Weaknesses</strong>

                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="swot_weaknesses" >{{$swot_weaknesses}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Opportunities</strong>

                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="swot_opportunities" >{{$swot_opportunities}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Threats</strong>

                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="swot_threats" >{{$swot_threats}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <strong>Ecological/ Environmental issues</strong>
                            <p><ol>

                            </ol></p>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="swot_issues" >{{$swot_issues}}</textarea>
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
                    url: '<?php echo url('swot-analysis') ?>',
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


